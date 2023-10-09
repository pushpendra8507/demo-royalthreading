<?php
include_once '../classes/startup.php';
$core = new Core;
$appointments = new Appointments;

if (!isset($_SESSION[ADMIN_SESSION])){
    header('location:index.php');die();
}

// if(isset($_POST['btn_submit']))
// {
//     $appointment_time = isset($_POST['booking_date'])?date('Y-m-d H:i:s', strtotime($_POST['booking_date'])):'';
//     $appointment_id = isset($_POST['appointment_id'])?$_POST['appointment_id']:'';
    
    // if(!empty($appointment_time) && !empty($appointment_id))
    // {
    //     if($appointments->updateAndSendEmail($appointment_id,$appointment_time))
    //     {
    //         $msg_title = "Appointment Confirmed";
    //         $msg_icon = "success";
    //         $page_url = SITEURL."admin/admin-appointment-details.php?view=".$appointment_id;
    //     }
        
    // }
// }

if(isset($_REQUEST["view"])){
    $details = $appointments->getAppointment($_REQUEST["view"]);
}



$page_name  = 'Appointments';
include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>   
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="admin-appointments.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Contact Form
                    <a href="javascript:void(0);" title="Add" class="btn btn-default myprint" id="<?php echo $_REQUEST["view"]; ?>" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none;"><i class="fa fa-print"></i>Print</a>
                </div>
                <div class="panel-body">
                <div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">Appointment Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><?php echo isset($details['name'])?$details['name']:'' ?></td>
                        <th>Email</th>
                        <td><?php echo isset($details['email'])?$details['email']:'' ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo isset($details['phone'])?$details['phone']:'' ?></td>
                        <th>Date</th>
                        <td><?php echo isset($details['created_at'])?date('m-d-Y H:i:s', strtotime($details['created_at'])):'' ?></td>
                    </tr>
                    <tr>
                        <th>Service</th>
                        <td colspan="4"><?php echo isset($details['service'])?$details['service']:'' ?></td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td colspan="4"><?php echo isset($details['description'])?$details['description']:'' ?></td>
                    </tr>
                </tbody>
            </table>
            
            
        </div>
    </div>
    
</div>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>

    <script>
    $('.myprint').on('click', function () {
        var appointment_id = this.id;
        $.ajax({
          type: 'POST',
          url: 'print_appointment.php',
          async: false,
          data: {'appointment_id': appointment_id},
          success: function (html) {
                     //alert(html);
                     var divToPrint;
                     newWin = window.open("");
                     newWin.document.write(html);
                     newWin.print();
                     newWin.close();
                 }
             });
    });
</script>

</body>
</html>