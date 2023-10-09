<?php
include_once '../classes/startup.php';
$core = new Core;
$blog_data = new MV_Blog;

if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}

if (isset($_POST['btn_submit'])) {
    $data['seo_title'] = (isset($_POST['seo_title']) && !empty($_POST['seo_title'])) ? $core->sanetize($_POST['seo_title']) : '';
    $data['title'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $core->sanetize($_POST['title']) : '';
    $data['seo_description'] = (isset($_POST['seo_description']) && !empty($_POST['seo_description'])) ? $core->sanetize($_POST['seo_description']) : '';

    $data['seo_keyword'] = (isset($_POST['seo_keyword']) && !empty($_POST['seo_keyword'])) ? ($_POST['seo_keyword']) : '';
    $data['seo_h1'] = (isset($_POST['seo_h1']) && !empty($_POST['seo_h1'])) ? ($_POST['seo_h1']) : '';
    $data['seo_h2'] = (isset($_POST['seo_h2']) && !empty($_POST['seo_h2'])) ? ($_POST['seo_h2']) : '';
    $data['tags'] = (isset($_POST['tags']) && !empty($_POST['tags'])) ? ($_POST['tags']) : '';

    $data['description'] = (isset($_POST['description']) && !empty($_POST['description']))? ($_POST['description']):'';  
    $data['date'] = (isset($_POST['date']) && !empty($_POST['date'])) ? ($_POST['date']) : '';
    $data['link'] = (isset($_POST['link']) && !empty($_POST['link'])) ? ($_POST['link']) : '';
      
    $data['alias'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $core->alias_url($_POST['title']) : '';
    $data['name'] = (isset($_POST['name']) && !empty($_POST['name'])) ? ($_POST['name']) : '';

    if (empty($_POST['status'])) {
        $last_insert_id = $blog_data->store($data);
    } else {
        $last_insert_id = $blog_data->update($_POST['status'], $data);
    }

    if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $last_insert_id > 0) {

        $path = '../uploads/';
        $core->UploadImage($_FILES['fu_photo'], $path, time() . $last_insert_id, 'tbl_blogs', 'photourl', 'id', $last_insert_id);
    }


    if ($last_insert_id > 0) {
        if (!empty($_POST['status'])) {
            $alert_data = array(
                "status" => "Updated successfully",
                "icon" => "success",
                "page_url" => "manage_blogs.php"
            );
        } else {
            $alert_data = array(
                "status" => "Added successfully",
                "icon" => "success",
                "page_url" => "manage_blogs_add.php"
            );
        }
    } else {
        $alert_data = array(
            "status" => "Something Went Wrong",
            "icon" => "error",
            "page_url" => "manage_blogs.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST["eid"])) {
    $details = $blog_data->get_details($_REQUEST["eid"]);
}

$page_name = 'Blogs';

include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_blogs.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    <?php echo isset($_REQUEST['eid']) ? "Edit" : "Add"; ?> Blogs Details
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="status" value="<?php echo (isset($_REQUEST['eid'])) ? $_REQUEST['eid'] : '' ?>">


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Seo-Title</label>
                                <input class="form-control" name="seo_title" value="<?php echo isset($details['seo_title']) ? html_entity_decode($details['seo_title']) : ""; ?>" />
                            </div>
                        </div>

                       

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Seo-Description</label>
                                <textarea class="form-control " rows="5" cols="10" name="seo_description"><?php echo isset($details['seo_description']) ? html_entity_decode($details['seo_description']) : '' ?></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">seo_keyword</label>
                                    <textarea class="form-control " rows="5" cols="10" name="seo_keyword"><?php echo isset($details['seo_keyword']) ? html_entity_decode($details['seo_keyword']) : '' ?></textarea>
                                </div>
                            </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Seo-h1</label>
                                <input class="form-control" name="seo_h1" value="<?php echo isset($details['seo_h1']) ? html_entity_decode($details['seo_h1']) : ""; ?>" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Seo-h2</label>
                                <input class="form-control" name="seo_titleh2" value="<?php echo isset($details['seo_h2']) ? html_entity_decode($details['seo_h2']) : ""; ?>" />
                            </div>
                        </div>
                      
 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Title</label>
                                <input class="form-control" name="title" value="<?php echo isset($details['title']) ? html_entity_decode($details['title']) : ""; ?>" />
                            </div>
                        </div>
                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Service Name</label>
                                <input class="form-control " name="name" value="<?php echo isset($details['name']) ? html_entity_decode($details['name']) : ""; ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Description </label>
                                    <textarea class="form-control description " rows="5" cols="10" name="description"><?php echo isset($details['description']) ? html_entity_decode($details['description']) : '' ?></textarea>
                                </div>
                        </div>
   
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Tags</label>
                                <textarea class="form-control " name="tags"><?php echo isset($details['tags']) ? html_entity_decode($details['tags']) : ""; ?></textarea>
                            </div>
                        </div>
                         
                         
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputEmail3">Video Link</label>
                                <input class="form-control " name="link" value="<?php echo isset($details['link']) ? html_entity_decode($details['link']) : ""; ?>">
                            </div>
                        </div>

                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputEmail3">Date</label>
                                <input type="text" class="form-control" name="date" value="<?php echo isset($details['date']) ? html_entity_decode($details['date']) : ""; ?>" />
                            </div>
                            </div>
 
                        <div class="col-md-6">
                                <div class="col-md-6">
                                    <label for="inputEmail3">Image </label>
                                    <input type="file" name="fu_photo" id="image" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage" src="<?php echo (!empty($details['photourl'])) ? '../' . $details['photourl'] : '' ?>" />
                                </div>
                            </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="btn_submit" value="SUBMIT" class="btn btn-primary">SUBMIT</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
</body>

</html>