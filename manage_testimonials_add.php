<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pr_testimonials = new MV_Testimonials;


if (isset($_POST['btn_submit'])) {

    $data['description'] = (isset($_POST['description']) && !empty($_POST['description'])) ? $core->sanetize($_POST['description']) : '';
    $data['name'] = (isset($_POST['name']) && !empty($_POST['name'])) ? $core->sanetize($_POST['name']) : '';
    // $data['email'] = (isset($_POST['email']) && !empty($_POST['email']))? $core->sanetize($_POST['email']):'';
    // $data['rating'] = (isset($_POST['rating']) && !empty($_POST['rating']))? $core->sanetize($_POST['rating']):'';

    if (empty($_POST['status'])) {
        $last_insert_id = $pr_testimonials->store($data);
    } else {
        $last_insert_id = $pr_testimonials->update($_POST['status'], $data);
    }

    // if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $last_insert_id>0) {
    //     $path = '../uploads/testimonials/';
    //     $core->UploadImage($_FILES['fu_photo'], $path, time().$last_insert_id, 'tbl_testimonials', 'photourl', 'id', $last_insert_id);
    // }

    if ($last_insert_id > 0) {
        if (!empty($_POST['status'])) {
            $alert_data = array(
                "status" => "Testimonial Updated",
                "icon" => "success",
                "page_url" => "manage_testimonials.php"
            );
        } else {
            $alert_data = array(
                "status" => "Testimonial Added",
                "icon" => "success",
                "page_url" => "manage_testimonials_add.php"
            );
        }
    } else {
        $alert_data = array(
            "status" => "Testimonial Not Added",
            "icon" => "error",
            "page_url" => "manage_testimonials.php"
        );
    }

    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST["eid"])) {
    $details = $pr_testimonials->get_details($_REQUEST["eid"]);
}





$page = 'Testimonials';
include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_testimonials.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    <?php echo isset($_REQUEST['eid']) ? "Edit" : "Add"; ?>
                    Testimonials
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" value="<?php echo $core->csrf_token() ?>" name="token">
                        <input type="hidden" name="status" value="<?php echo isset($_REQUEST['eid']) ? $_REQUEST['eid'] : ""; ?>">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- <label for="inputEmail3"> Rating </label> -->
                                    <!-- <select name="rating" class="form-control" required>
                                        <option value="">Select Rating</option>
                                        <option value="5" <?php echo (isset($details['rating']) && $details['rating'] == 5) ? 'selected' : '' ?>>5</option>
                                        <option value="4" <?php echo (isset($details['rating']) && $details['rating'] == 4) ? 'selected' : '' ?>>4</option>
                                        <option value="3" <?php echo (isset($details['rating']) && $details['rating'] == 3) ? 'selected' : '' ?>>3</option>
                                        <option value="2" <?php echo (isset($details['rating']) && $details['rating'] == 2) ? 'selected' : '' ?>>2</option>
                                        <option value="1" <?php echo (isset($details['rating']) && $details['rating'] == 1) ? 'selected' : '' ?>>1</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Name </label>
                                    <input type="text" name="name" value="<?php echo (isset($details['name'])) ? $details['name'] : ''; ?>" class="form-control" id="inputEmail3">
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="inputEmail3"> Image  </label>
                                        <input type="file" name="fu_photo" id="image"  /> 
                                    </div>
                                    <div class="col-md-6">
                                    <img width="80" id="showImage" src="" /> 
                                </div>
                                </div>
                            </div> -->
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail3"> Email </label>
                                    <input type="text" name="email" value="<?php echo (isset($details['email'])) ? $details['email'] : ''; ?>"  class="form-control" id="inputEmail3" >
                                </div>
                            </div> -->


                        </div>

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Description </label>

                                    <textarea name="description" required="" class="form-control"><?php echo (isset($details['description'])) ? html_entity_decode($details['description']) : ''; ?></textarea>
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $('#date_added').datepicker({
            maxDate: 0
        });
    </script>

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