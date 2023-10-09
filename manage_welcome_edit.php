<?php
include_once '../classes/startup.php';
$core = new Core;
$mv_welcome = new MV_Welcome;

$about = $mv_welcome->index();

if (isset($_POST['btn_submit'])) {
    $payload = [];
    $payload['description_1'] = isset($_POST['description_1']) ? $_POST['description_1'] : '';
    // $payload['description_2'] = isset($_POST['description_2'])?$_POST['description_2']:'';

    $update_id = $mv_welcome->update($_POST);
    if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $update_id > 0) {
        $path = '../uploads/welcome/';
        $core->UploadImage($_FILES['fu_photo'], $path, 'envision_carpentry-' . time() . $update_id, 'tbl_welcome', 'photourl_1', 'id', 1);
    }
    if (isset($_FILES['fu_photo_1']) && $_FILES['fu_photo_1']['name'] != "" && $update_id > 0) {
        $path = '../uploads/welcome/';
        $core->UploadImage($_FILES['fu_photo_1'], $path, 'envision_carpentry-' . time() . $update_id, 'tbl_welcome', 'photourl_2', 'id', 1);
    }


    if ($update_id > 0) {
        $alert_data = array(
            "status" => "updated",
            "icon" => "success",
            "page_url" => "manage_welcome.php"
        );
    } else {
        $alert_data = array(
            "status" => "Not updated",
            "icon" => "error",
            "page_url" => "manage_welcome.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

$details = $mv_welcome->index();
$page = 'Welcome';
include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_welcome.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Edit Welcome
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="inputEmail3"> Image </label>
                                        <input type="file" name="fu_photo" id="image" />
                                    </div>
                                    <div class="col-md-6">
                                        <img width="80" id="showImage" src="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3">Image 2</label>
                                    <input type="file" name="fu_photo_1" id="image1" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage1" src="" />
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="inputEmail3">Description 1</label>
                                <textarea class="form-control description" name="description_1" required><?php echo (isset($details['description_1'])) ? html_entity_decode($details['description_1']) : '' ?></textarea>

                            </div>
                            <!-- <div class="col-md-12">
                                <label for="inputEmail3">Description 2</label>
                                <textarea class="form-control description" name="description_2" required><?php echo (isset($details['description_2'])) ? html_entity_decode($details['description_2']) : '' ?></textarea>
                                
                            </div> -->
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
</body>
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

</html>