<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}

$core = new Core;
$pr_videos = new PR_Videos;

if(isset($_POST['btn_submit']))
{
    $payload = [];

    $payload['title']       = isset($_POST['title'])?$_POST['title']:'';
    $payload['youtube_link'] = isset($_POST['youtube_link'])?$_POST['youtube_link']:'';

    if($last_insert_id = $pr_videos->store($payload))
    {
        
        $alert_data = array(
            "status"=>"Image Added",
            "icon"=>"success",
            "page_url"=>"manage_videos.php"
        );
    }
    else
    {
        $alert_data = array(
            "status"=>"Image Not Added",
            "icon"=>"error",
            "page_url"=>"manage_videos.php"
        );
    }

    $core->set_sweetalert($alert_data);
}

if(isset($_REQUEST['did']))
{
    if($pr_videos->delete($_REQUEST['did']))
    {
        $alert_data = array(
            "status"=>"Image Deleted",
            "icon"=>"error",
            "page_url"=>"manage_videos.php"
        );
        $core->set_sweetalert($alert_data);
    }
}

$video_data = $pr_videos->video_list();



$page_name='Videos';

include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_gallery_category.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Services
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <div class="form-group">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="vid" value="<?php echo isset($_REQUEST['vid'])?$_REQUEST['vid']:'' ?>">
                                            <div class="col-md-3">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Select Image</label>
                                                <input type="text" class="form-control" name="youtube_link" required>
                                            </div>
                                            <div class="col-md-3">
                                                <button name="btn_submit" type="submit" style="margin-top:1.5rem;" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th>Title</th>
                                <th>Video</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            foreach($video_data as $video_dt)
                            {
                            ?>
                                <tr>
                                    <td><?php echo isset($video_dt['title'])?$video_dt['title']:'' ?></td>
                                    <td>
                                        <?php echo isset($video_dt['youtube_link'])?$video_dt['youtube_link']:'' ?></td>
                                    
                                    <td><a href="manage_videos.php?did=<?php echo isset($video_dt['id'])?$video_dt['id']:'' ?>"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <?php include("includes/footer.php"); ?>
    </div>

</body>
</html>
