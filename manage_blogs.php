<?php
include_once '../classes/startup.php';
$core = new Core;
$mv_blog = new MV_Blog;

if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}


if (isset($_REQUEST['did'])) {
    $did = (int)$_REQUEST['did'];
    if ($mv_blog->delete($did)) {
        $alert_data = array(
            "status" => "Deleted successfully",
            "icon" => "success",
            "page_url" => "manage_blogs.php"
        );
    }

    $core->set_sweetalert($alert_data);
}
$all_projects = $mv_blog->index_limit();


$page_name = 'Blog';
include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="javascript:history.go(-1)" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Blog Pages
                    <a href="manage_blogs_add.php" title="Add" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none; font-weight: bold;"> Add</a>
                </div>
                <div class="panel-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No</th>
                                <th scope="col">Title</th>                               
                                <th scope="col">Image</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1;
                            foreach ($all_projects as $glry) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt ?></td>

                                    
                                    <td><?php echo isset($glry['title']) ? $glry['title'] : '' ?></td>
                                   
                                    <td>
                                        <img src="<?php echo isset($glry['photourl']) ? '../' . $glry['photourl'] : 'images/noimage.png' ?>" width="50" alt="">
                                    </td>

                                    <td>
                                        <a href="manage_blogs_add.php?eid=<?php echo $glry['id'] ?>"><span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></span></a>
                                    </td>
                                    <td>
                                        <a href="manage_blogs.php?did=<?php echo $glry['id'] ?>"><span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="Delete"></span></a>
                                    </td>
                                </tr>
                            <?php
                                $cnt++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>

    <script type="text/javascript">
        function ChangeStatus(id, page, activatedstatus) {
            document.location.href = "admin-gallery.php?gallery=" + id + "&page=" + page + "&gsts=" + activatedstatus;
        }
    </script>

</body>

</html>