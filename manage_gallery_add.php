<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pb_work = new MV_Work;


if (isset($_POST['btn_submit'])) {
    $data['alt_name_home'] = (isset($_POST['alt_name_home']) && !empty($_POST['alt_name_home'])) ? $_POST['alt_name_home'] : '';

    $data['alt_name'] = (isset($_POST['alt_name']) && !empty($_POST['alt_name'])) ? $_POST['alt_name'] : '';

    $data['title'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';


    if (empty($_POST['status'])) {
        $last_insert_id = $pb_work->store($data);
    } else {
        $last_insert_id = $pb_work->update($_POST['status'], $data);
    }

    if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $last_insert_id > 0) {
        $path = '../uploads/gallery';
        $core->UploadImage($_FILES['fu_photo'], $path, 'Royalthreding' . time() . $last_insert_id, 'tbl_our_work', 'photourl', 'id', $last_insert_id);
    }

    if (isset($_FILES['fu_photo_home']) && $_FILES['fu_photo_home']['name'] != "" && $last_insert_id > 0) {
        $path = '../uploads/galler_home';
        $core->UploadImage($_FILES['fu_photo_home'], $path, 'Royalthreding-home' . time() . $last_insert_id, 'tbl_our_work', 'photourl_1', 'id', $last_insert_id);
    }

    if ($last_insert_id > 0) {
        if (!empty($_POST['status'])) {
            $alert_data = array(
                "status" => "Record Updated",
                "icon" => "success",
                "page_url" => "manage_gallery.php"
            );
        } else {
            $alert_data = array(
                "status" => "Record Added",
                "icon" => "success",
                "page_url" => "manage_gallery.php"
            );
        }
    } else {
        $alert_data = array(
            "status" => "something went wrong",
            "icon" => "error",
            "page_url" => "manage_gallery.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST["eid"])) {
    $details = $pb_work->get_details($_REQUEST["eid"]);
}



$page_name = 'Our gallery';

include("includes/top_header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_gallery.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    <?php echo isset($_REQUEST['eid']) ? "Edit" : "Add"; ?>
                    Gallery
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="status" value="<?php echo (isset($_REQUEST['eid'])) ? $_REQUEST['eid'] : ""; ?>">
                        <div class="col-md-12">

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo isset($details['title']) ? html_entity_decode($details['title']) : '' ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Alt_Name_Home</label>
                                    <input type="text" name="alt_name_home" class="form-control" value="<?php echo isset($details['alt_name_home']) ? html_entity_decode($details['alt_name_home']) : '' ?>">
                                </div>
                            </div>

                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Alt_Name_Gallery</label>
                                    <input type="text" name="alt_name" class="form-control" value="<?php echo isset($details['alt_name']) ? html_entity_decode($details['alt_name']) : '' ?>">
                                </div>
                            </div>

                            <div class="col-md-6" style="margin-bottom: 32px;">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="inputEmail3"> Image </label>
                                        <input type="file" name="fu_photo" id="image" value="" /><?php echo isset($details['photourl']) ? html_entity_decode($details['photourl']) : '' ?>
                                    </div>
                                    <div class="col-md-6">
                                        <img width="80" id="showImage" src="<?php echo (!empty($details['photourl']))?'../'.$details['photourl']:'' ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="margin-bottom: 32px;">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="inputEmail3"> Image Of Homepage </label>
                                        <input type="file" name="fu_photo_home" id="image1" value="" /><?php echo isset($details['photourl_1']) ? html_entity_decode($details['photourl_1']) : '' ?>
                                    </div>
                                    <div class="col-md-6">
                                        <img width="80" id="showImage1" src="" />
                                    </div>
                                </div>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image1').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage1').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

</body>

</html>