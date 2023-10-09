<?php
include'classes/startup.php';
include_once 'ContactFunctions.php';
$appointments = new Appointments;

if(isset($_POST) && isset($_POST["btn_submit"]))
{
    if (!isset($_SERVER['HTTP_REFERER']) || (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['SERVER_NAME'])) {
        echo '<script>window.location="./"</script>'; exit;
    }

    $name = $email = $phone = $form_subject = $date_time = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $secretKey  = '6LdmU3YlAAAAAJfZ_JULzKfDZDUe7TWrW_mn7gw8';
        $token    = $_POST["g-token"];
        $ip     = $_SERVER['REMOTE_ADDR'];
      
        if(empty($_POST["name"]))
        {
            echo '<script>window.location="./"</script>'; exit;
        } 
        else
        {
            $name = filterName($_POST["name"]);
            if($name == FALSE){
                echo '<script>window.location="./"</script>'; exit;
            }
        }
    
        if(empty($_POST["email"]))
        {
            echo '<script>window.location="./"</script>'; exit;    
        } 
        else
        {
            $email = filterEmail($_POST["email"]);
            if($email == FALSE){
                echo '<script>window.location="./"</script>'; exit;
            }
        }

        $phone = (isset($_POST["phone"]) && !empty($_POST["phone"]))? $_POST["phone"]: '';
        $form_subject = (isset($_POST["service"]) && !empty($_POST["service"]))? $_POST["service"]: '';
       
        $date = (isset($_POST["date"]) && !empty($_POST["date"]))?date("Y-m-d", strtotime($_POST["date"])):'';
        $time = (isset($_POST["date"]) && !empty($_POST["time"]))?date("H:i", strtotime($_POST["time"])):'';
        
        $date_time = date('Y-m-d H:i:s', strtotime($date."  ".$time));

     
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = array('secret' => $secretKey, 'response' => $token, 'remoteip'=> $ip);

          // use key 'http' even if you send the request to https://...
        $options = array('http' => array(
            'method'  => 'POST',
            'content' => http_build_query($data)
        ));
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);
        // echo '<pre>';print_r($response);die();
        if($response->success)
        {
            $payload = [];
            $payload['name'] = isset($_POST['name'])?$_POST['name']:'';
            $payload['email'] = isset($_POST['email'])?$_POST['email']:'';
            $payload['phone'] = isset($_POST['phone'])?$_POST['phone']:'';
            $payload['service'] = isset($_POST['service'])?$_POST['service']:'';
            $payload['date'] = isset($_POST['date'])?$_POST['date']:'';
            $payload['time'] = isset($_POST['time'])?$_POST['time']:'';
            
            if(!empty($payload['name']) && !empty($payload['email']) && !empty($payload['phone']) && !empty($payload['service']) && !empty($payload['date']) && !empty($payload['time']))
            {
                $appointments->create_appointment($payload);
            }
            
            define('BUSINESS_NAME','Royal Threading Center');
            define('FORM_TYPE','Book Now');
            $to = 'royalthreading@gmail.com';
            // $to = 'ravi02.agp@gmail.com';
            $fromMail = 'no-reply@royalthreadings.com';
            $fromName = BUSINESS_NAME;
            $subject = BUSINESS_NAME.' - '.FORM_TYPE;
            $message = '<html><head><title>'.BUSINESS_NAME.'</title></head><body><div style="background:#F2F2F2; text-align:center; padding:50px;">
                <table  width="60%" border="0" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF" style="border:1px #ccc solid; border-collapse:collapse;">

                <tr>
                <td height="25"  colspan="2"><center><strong>'.BUSINESS_NAME.'</strong></center></td>
                </tr>
                </table>
                <table width="60%" align="center" cellpadding="6" cellspacing="0" bgcolor="#FFFFFF" style="border:1px #ccc solid; border-collapse:collapse;">                  
                    <tbody>
                        <tr>
                            <td width="100%" valign="top">
                                <table width="100%" cellspacing="3" cellpadding="5" border="1" >
                                    <tbody>     
                                        <tr>
                                            <td colspan="2"><center><strong>'.FORM_TYPE.'</strong></center></td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Name:</td>
                                            <td width="70%">' . $name . '</td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>' . $email . '</td>
                                        </tr>
                                        <tr>
                                            <td>Phone:</td>
                                            <td>' . $phone . '</td>
                                        </tr>
                                        <tr>
                                            <td>Service:</td>
                                            <td>' . $form_subject . '</td>
                                        </tr>
                                        <tr>
                                            <td>Date & Time:</td>
                                            <td>' . $date_time . '</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div></body></html>';
                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                $headers .= 'From:'.$fromName." ".'<'.$fromMail.'>'."\r\n";
                $headers .= 'Bcc: contact@wxperts.co' . "\r\n";
                // $headers .= 'Bcc: ravi02.agp@gmail.com' . "\r\n";
                $headers .= 'Bcc: anand@agpt.in' . "\r\n";
                $message = str_replace("\'", "'", $message);
                //echo $message;exit;
                $send_mail = mail($to, $subject, $message, $headers);

                if($send_mail)
                {
                   echo '<script>alert("Thank you. We received your message! We will be in touch.");window.location="./"</script>';
               }
               else 
               {
                   echo '<script> alert("Sorry. Mail not sent ! Try again.!");window.location="./" </script>';
               }
           }
           else
           {
            echo '<script> alert("Invalid captcha.!");window.location="./"</script>';
           }
        }
}

?>
<script type="text/javascript">

    function getISODate(){
  var d = new Date();
  return d.getFullYear() + '-' + 
          ('0' + (d.getMonth()+1)).slice(-2) + '-' +
          ('0' + d.getDate()).slice(-2);
}

window.onload = function() {
  document.getElementById('minToday').setAttribute('min',getISODate());
}
</script>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Book Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-style2 custom-form">
                    <input type="hidden" id="g-token" name="g-token" />
                    <div class="form-group"><input name="name" type="text" placeholder="Your Name"></div>
                    <div class="form-group"><input name="email" type="email" placeholder="Email Address"></div>
                    <div class="form-group"><input name="phone" type="text" placeholder="Phone Number"></div>
                    <div class="form-group"><input name="service" type="text" placeholder="Service"></div>
                    <div class="form-group"><input name="date" id="minToday" type="date"></div>
                    <div class="form-group"><input name="time" type="time"></div>
                    <div class="form-group"><button class="vs-btn" name="btn_submit" type="submit">Submit Now</button></div>
                </form>
            </div>
        </div>
    </div>
</div>          