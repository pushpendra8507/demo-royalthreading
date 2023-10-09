<?php 
include_once('../classes/startup.php');
if (!isset($_SESSION[ADMIN_SESSION])){
    header('location:./'); die();
}
$appointments = new Appointments;
if (isset($_POST['appointment_id'])) {
    $appointment_id = (int)$_POST['appointment_id'];

    echo $appointments->print_appointment($appointment_id);
}



?>