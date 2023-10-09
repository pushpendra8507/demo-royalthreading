<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pr_testimonials = new MV_Testimonials;

if (isset($_REQUEST['did'])) {
    $did = (int)$_REQUEST['did'];
    if ($pr_testimonials->delete($did)) {
        $alert_data = array(
            "status" => "Testimonial Deleted",
            "icon" => "success",
            "page_url" => "manage_testimonials.php"
        );
    } else {
        $alert_data = array(
            "status" => "Testimonial Not Deleted",
            "icon" => "error",
            "page_url" => "manage_testimonials.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST['status']) && isset($_REQUEST['tid'])) {
    $status = isset($_REQUEST['status']) ? $_REQUEST['status'] : '';
    $id = isset($_REQUEST['tid']) ? $_REQUEST['tid'] : '';

    if ($pr_testimonials->updateStatus($status, $id)) {
        $alert_data = array(
            "status" => "Status Updated",
            "icon" => "success",
            "page_url" => "manage_testimonials.php"
        );
    } else {
        $alert_data = array(
            "status" => "Status not updated",
            "icon" => "error",
            "page_url" => "manage_testimonials.php"
        );
    }
    $core->set_sweetalert($alert_data);
}



$testimonials = $pr_testimonials->index();

$page_name = 'Testimonials';
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
                    Testimonials
                    <a href="manage_testimonials_add.php" title="Add" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none;">Add Testimonials</a>
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Sr. No</th>
                                <th scope="col">Name</th>
                                <!-- <th scope="col">Email</th> -->
                                <th scope="col">Description</th>
                                <!-- <th scope="col">Status</th> -->
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($testimonials) > 0) {
                                $counter = 1;
                                foreach ($testimonials as $testimonial) {

                            ?>
                                    <tr>
                                        <td><?php echo $counter ?></td>
                                        <td><?php echo $testimonial['name'] ?></td>
                                        <!-- <td>
                                            <img src="<?php echo isset($testimonial['photourl']) ? '../' . $testimonial['photourl'] : 'images/noimage.png' ?>" width="50"  alt="">
                                        </td> -->
                                        <!-- <td><?php echo html_entity_decode($testimonial['email']) ?></td> -->
                                        <td><?php echo html_entity_decode($testimonial['description']) ?></td>



                                        <td><a href="manage_testimonials_add.php?eid=<?php echo $testimonial['id'] ?>"><span class="fa fa-pencil-square-o"></span></a></td>
                                        <td><a href="manage_testimonials.php?did=<?php echo $testimonial['id'] ?>"><span class="fa fa-trash-o"></span></a></td>

                                    </tr>
                                <?php
                                    $counter++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Testimonial added.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <?php include("includes/footer.php"); ?>
    </div>

</body>

</html>