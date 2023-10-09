<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
date_default_timezone_set("America/New_York");
error_reporting(E_ALL);
error_reporting(0);
session_start();

require_once('site_config.php');
require_once('Database.php');
require_once('Core.php');
require_once('AdminCoreFunctions.php');
require_once('PaginateIt.php');



/* project specific classes start*/
require_once('MV_ContactUs.php');
require_once('MV_Gallery.php');
require_once('MV_Videos.php');
require_once('MV_AboutUs.php');
require_once('MV_Testimonials.php');
require_once('MV_Services.php');
require_once('MV_Welcome.php');
require_once('MV_Blogs.php');
require_once('Appointments.php');
require_once('PrintAppointment.php');

/* project specific classes end*/



require_once('SendMail.php');



?>

