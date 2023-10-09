<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
if (!isset($_REQUEST['vid']) || empty($_REQUEST['vid'])) {
    header('location:manage_gallery_category.php');
    exit;
}
$core = new Core;
$pr_services = new MV_Gallery;

if (isset($_POST['btn_submit'])) {
    $payload = [];

    $payload['title']       = isset($_POST['title']) ? $_POST['title'] : '';
    $payload['prize']       = isset($_POST['prize']) ? $_POST['prize'] : '';
    $payload['category_id'] = isset($_POST['vid']) ? $_POST['vid'] : '';
    // $payload['alt_text']    = $core->alias_url($payload['title']);

    if ($last_insert_id = $pr_services->store_item_details($payload)) {
        if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $last_insert_id > 0) {
            $path = '../uploads/gallery/';
            $core->UploadImage($_FILES['fu_photo'], $path, 'royalthreading-' . time() . $last_insert_id, 'tbl_gallery', 'photourl', 'id', $last_insert_id);
        }
        $alert_data = array(
            "status" => "Image Added",
            "icon" => "success",
            "page_url" => "manage_gallery_category_details.php?vid=" . $_POST['vid']
        );
    } else {
        $alert_data = array(
            "status" => "Image Not Added",
            "icon" => "error",
            "page_url" => "manage_gallery_category_details.php?vid=" . $_POST['vid']
        );
    }

    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST['did'])) {
    if ($pr_services->delete_image($_REQUEST['did'])) {
        $alert_data = array(
            "status" => "Image Deleted",
            "icon" => "error",
            "page_url" => "manage_gallery_category_details.php?vid=" . $_REQUEST['vid']
        );
        $core->set_sweetalert($alert_data);
    }
}

$category_data = $pr_services->get_details($_REQUEST['vid']);

$category_images = $pr_services->get_category_images($_REQUEST['vid']);


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
                    <a href="manage_gallery_category.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Services
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3"><?php echo isset($category_data['name']) ? $category_data['name'] : '' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <div class="form-group">
                                        <form method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="vid" value="<?php echo isset($_REQUEST['vid']) ? $_REQUEST['vid'] : '' ?>">
                                            <div class="col-md-12">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control " required>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Prize</label>
                                                <input type="text" name="prize" class="form-control " required>
                                            </div>
                                            <!-- <div class="col-md-3">
                                                <label>Select Image</label>
                                                <input type="file" name="fu_photo" required>
                                            </div> -->
                                            <div class="col-md-3">
                                                <button name="btn_submit" type="submit" style="margin-top:1.5rem;" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <tr>

                                <th>Service</th>

                                <th>Prize</th>
                                <!-- <th>Edit</th> -->
                                <th>Delete</th>
                            </tr>
                            <?php
                            foreach ($category_images as $category_image) {
                            ?>
                                <tr>
                                    <!-- <td><img width="50" src="<?php echo isset($category_image['photourl']) ? '../' . $category_image['photourl'] : '' ?>"></td> -->
                                    <td><?php echo isset($category_image['title']) ? $category_image['title'] : '' ?></td>
                                    <td><?php echo isset($category_image['prize']) ? $category_image['prize'] : '' ?></td>

                                    <!-- <td><a href="manage_our_projects_add.php?eid=<?php echo $glry['id'] ?>"><span class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="top" title="Edit"></span></a></td> -->
                                    <td><a href="manage_gallery_category_details.php?vid=<?php echo $_REQUEST['vid'] . '&did=' . $category_image['id'] ?>"><i class="fa fa-trash-o"></i></a></td>
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