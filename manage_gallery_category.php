<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pr_services = new MV_Gallery;

if (isset($_REQUEST['did'])) {
    $did = (int)$_REQUEST['did'];
    if ($pr_services->delete_category($did)) {
        $alert_data = array(
            "status" => "Record Deleted",
            "icon" => "success",
            "page_url" => "manage_gallery_category.php"
        );
    } else {
        $alert_data = array(
            "status" => "Record Not Deleted",
            "icon" => "error",
            "page_url" => "manage_gallery_category.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

$category_data = $pr_services->category_list();




$page_name = 'Gallery';

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
                    Gallery
                    <a href="manage_gallery_category_add.php" title="Add" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none;">Add New</a>
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1;
                            foreach ($category_data as $category_dt) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt ?></td>
                                    <td><a href="manage_gallery_category_details.php?vid=<?php echo isset($category_dt['id']) ? $category_dt['id'] : '' ?>"><?php echo isset($category_dt['title']) ? $category_dt['title'] : '' ?></td>
                                    <td><a href="manage_gallery_category_add.php?eid=<?php echo $category_dt['id'] ?>"><span class="fa fa-pencil-square-o"></span></a></td>
                                    <td><a href="manage_gallery_category.php?did=<?php echo $category_dt['id'] ?>"><span class="fa fa-trash-o"></span></a></td>

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

</body>

</html>