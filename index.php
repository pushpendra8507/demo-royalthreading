<?php
include_once '../classes/startup.php';
// echo md5(md5('admin3038'));
// die;

$core = new Core;

$admin = new AdminCoreFunctions;



if (isset($_REQUEST['btn_submit'])) {

    if ($core->verify_token($_POST['token']) == 'yes') {

        $LoginId = $_POST["txt_user"];

        $Password = $_POST["txt_password"];



        $LoginId = str_replace("'", "", $LoginId);

        $LoginId = str_replace('"', "", $LoginId);



        $Password = str_replace("'", "", $Password);

        $Password = str_replace('"', "", $Password);





        if ($admin->validate_login($LoginId, $Password) == 0) {



            $msg = "Incorrect Login Id Or Password";

        } else {

           $admin_detils = $admin->get_admin_details($LoginId, $Password);

           if(!empty($admin_detils['aid']) && $admin_detils['username'])
           {
                $_SESSION[ADMIN_SESSION]        = $admin_detils["aid"];
                $_SESSION[ADMIN_SESSION_EMAIL]  = $admin_detils["username"];

                header('location:dashboard.php');

           }

        }

    } else {

        echo '<script>alert("You are not permited to access");</script>';

    }

}

include("includes/top_header.php");

?>



<body>

    <div class="keycode-admin-page">

        <form role="form" method="post">

            <input type="hidden" value="<?php echo $core->csrf_token() ?>" name="token">

            <div id="login">

                <div class="logo-area">

                    <div class="logo-top">

                        <img src="<?php echo SITELOGO ?>" class="img-responsive" alt="<?php echo ADMIN_TITLE; ?>" style="height:220px !important;background: black;padding: 16px;">

                    </div>

                </div>

                <div class="admin-detail">

                    <ul>

                        <li><center><label><strong><h3>ADMIN LOGIN</h3></strong></label></center></li>

                        <li>

                            <label>User Name</label>

                            <input type="text" name="txt_user" id="email" class="form-control" placeholder="User Name">

                        </li>

                        <li>

                            <label>Password</label>

                            <input type="password" name="txt_password" id="password" class="form-control" placeholder="Password">

                        </li>

                        <?php if (isset($msg)) { ?> 

                            <div class="col-md-12 submit">

                                <p style="color: #f20; font-weight: bold;"> <?php echo $msg ?></p>

                            </div>

                        <?php } ?>

                        <input type="submit" name="btn_submit" class="btn btn-lg btn-success btn-block" value="SUBMIT">

                        <span><a href="forgot-password.php" onclick="#"> <i class="fa fa-key" style="color: #FFF;"> Forgot Password? </i></a></span>

                    </ul>

                </div>

                <div class="clear"></div>



            </div>

        </form>

        <div class="clear"></div>

    </div>

</body>

</html>