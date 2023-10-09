<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pb_work = new MV_Work;

if (isset($_REQUEST['did'])) {
    $did = (int)$_REQUEST['did'];
    if ($pb_work->delete($did)) {
        $alert_data = array(
            "status" => "Record Deleted",
            "icon" => "success",
            "page_url" => "manage_gallery.php"
        );
    } else {
        $alert_data = array(
            "status" => "Record Not Deleted",
            "icon" => "error",
            "page_url" => "manage_gallery.php"
        );
    }
    $core->set_sweetalert($alert_data);
} else if (isset($_REQUEST['homepage'])) {
    $status = (isset($_REQUEST['status']) && $_REQUEST['status'] == 1) ? 0 : 1;
    $pb_work->update_homepage_status($_REQUEST['homepage'], $status);
    $alert_data = array(
        "status" => "Service Updated",
        "icon" => "success",
        "page_url" => "manage_gallery.php"
    );
    $core->set_sweetalert($alert_data);
}
$gallery_data = $pb_work->index(2);




$page_name = 'Our gallery';

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
                    gallery
                    <a href="manage_gallery_add.php" title="Add" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none;">Add New</a>
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Image of HomePage</th>
                                <th scope="col">Action</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cnt = 1;
                            foreach ($gallery_data as $gallery_datas) {
                            ?>
                                <tr>
                                    <td><?php echo $cnt ?></td>
                                    <td><?php echo isset($gallery_datas['title']) ? $gallery_datas['title'] : '' ?></td>
                                    <td>
                                        <img src="<?php echo isset($gallery_datas['photourl']) ? '../' . $gallery_datas['photourl'] : 'images/noimage.png' ?>" width="50" alt="">
                                    </td>

                                    <td>
                                        <img src="<?php echo isset($gallery_datas['photourl_1']) ? '../' . $gallery_datas['photourl_1'] : 'images/noimage.png' ?>" width="50" alt="">
                                    </td>
                                    <!-- <td><?php echo isset($gallery_datas['description']) ? $gallery_datas['description'] : '' ?></td> -->

                                    <?php
                                    if ($gallery_datas['homepage'] == 1) {
                                    ?>
                                        <td>
                                            <a href="manage_gallery.php?homepage=<?php echo $gallery_datas['id'] . '&status=' . $gallery_datas['homepage'] ?>"><span class="fa fa-check-circle" style="margin-right:1rem; color:green;"></span>Show On Homepage</a>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td>
                                            <a href="manage_gallery.php?homepage=<?php echo $gallery_datas['id'] . '&status=' . $gallery_datas['homepage'] ?>"><span class="fa fa-times-circle" style="margin-right:1rem; color:red;"></span>Show On Homepage</a>
                                        </td>
                                    <?php
                                    }
                                    ?>

                                    <td><a href="manage_gallery_add.php?eid=<?php echo $gallery_datas['id'] ?>"><span class="fa fa-pencil-square-o"></span></a></td>
                                    <td><a href="manage_gallery.php?did=<?php echo $gallery_datas['id'] ?>"><span class="fa fa-trash-o"></span></a></td>

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