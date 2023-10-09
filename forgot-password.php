<?php
include_once '../classes/startup.php';
$core = new Core;
$admin = new AdminCoreFunctions;

if (isset($_POST['btn_submit'])) {
    $email = isset($_POST['txt_email']) ? $_POST['txt_email'] : '';

    if (!$admin->check_admin_email($email)) {
        echo '<script>alert("Email does not exist"); window.location="index.php";</script>';
    }

    $random_password = $admin->RandomString();
    //echo $random_password;die();

    $fpass = $admin->forgot_password($email);
    $set_new_password = $admin->setNewPassword($random_password);

    $username = $core->sanetize($fpass['username']);
    $password = $random_password;
    $aemail = $core->sanetize($fpass['email']);

    $to = $aemail;
    //$to = 'ram.sharan@wserve.com'; // add additional mail receipient here
    $fromMail = $aemail;
    $fromName = ADMIN_TITLE;
    $subject = 'Admin Panel Password';
    $message = '<div id="ox-f97ec5ebd2"><div style="font-family:sans-serif; text-align: center; background-color: #F1F3F4;"> 
     <div style="height: 20px;"></div> 
     <div style="margin: 0 auto; max-width: 48%; border: none; background-color: #fff;"> 
      <img src="' . SITEURL . 'assets/img/logo.jpg" class="img-responsive" alt="' . ADMIN_TITLE . '" width="300px"> 
     </div> 
      
     <div style="height: 20px;"></div> 
     <div style="padding: 30px 20px; margin: 0 auto; background-color: #ffffff; width: 600px; max-width: 50%; border-radius: 8px;"> 
      <p style="text-align: left; font-size: 16px; font-weight: normal;"> Dear Admin <br><br> Your User Name And Password to your Admin Dashboard:<br><br> User Name - <strong>' . $username . '</strong> <br><br> Password - <strong>' . $password . '</strong> <br><br> Please click the following link for login your Admin Dashboard:<br><br> <a href="' . SITEURL . 'admin/" target="_blank" rel="noopener">Click Here</a> <br><br><br><br> Powered by <a href="' . SITEURL . '">' . ADMIN_TITLE . '</a> <br><br> Best Regards </p> 
     </div> 
     <div style="height: 150px;"></div> 
    </div></div>';
    // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From:' . $fromName . " " . '<' . $fromMail . '>' . "\r\n";
    $message = str_replace("\'", "'", $message);
    //echo $message;exit;
    $send_mail = mail($to, $subject, $message, $headers);

    if ($send_mail) {
        echo '<script>alert("Password send successfully. Please check your Email.");window.location="index.php"</script>';
    } else {
        echo '<script> alert("Sorry. Mail not sent ! Try again.!");window.location="index.php"</script>';
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

                        <img src="<?php echo SITELOGO ?>" class="img-responsive" alt="<?php echo ADMIN_TITLE; ?>"
                            style="height:220px !important;background: black;padding: 16px;">

                    </div>

                </div>
                <div class="admin-detail">
                    <ul>
                        <li>
                            <center><label><strong>
                                        <h3>ADMIN LOGIN</h3>
                                    </strong></label></center>
                        </li>
                        <li>
                            <label>Email</label>
                            <input type="text" name="txt_email" id="email" class="form-control" placeholder="Email">
                        </li>

                        <input type="submit" name="btn_submit" class="btn btn-lg btn-success btn-block" value="SUBMIT">
                    </ul>
                </div>
                <div class="clear"></div>

            </div>
        </form>
        <div class="clear"></div>
    </div>
</body>

</html>