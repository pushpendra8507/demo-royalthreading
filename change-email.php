<?php
include_once '../classes/startup.php';

$core = new Core;

$admin = new AdminCoreFunctions;



if (!isset($_SESSION[ADMIN_SESSION])){

    header('location:index.php');

}



if (isset($_POST['btn_submit'])) {

    if ($core->verify_token($_POST['token']) == 'yes') {

        $cemail = $core->sanetize($_POST['cemail']);

        if ($admin->change_email($cemail) == 1) {

            $alert_data= array(

                "status"=>"Email Changed Successfully",

                "icon"=>"success",

                "page_url"=>"change-email.php"

            );

        }

        $core->set_sweetalert($alert_data);

    } 

    else {

        echo '<script>alert("You are not permited to access");window.location="change-email.php";</script>';

    }

}


$page_name='Email';

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

                    Change Email

                </div>



                <div class="panel-body">

                    <form method="post" enctype="multipart/form-data">

                        <input type="hidden" value="<?php echo $core->csrf_token() ?>" name="token">

                        <div class="col-lg-6">

                            <div class="form-group row">

                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email Address</label>

                                <div class="col-sm-8">

                                    <input type="email" name="cemail" value="<?php echo $admin->get_admin_email() ?>" class="form-control" id="inputEmail3" placeholder="Email Address">

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

</body>

</html>