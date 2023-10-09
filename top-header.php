<?php 
include('classes/startup.php');
$core = new Core;
?>

<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SITEURL; ?>assets/img/logo.png">

<?php $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
<meta name="author" content="<?php echo isset($url)?$url:'' ?>" />
<meta name="robots" content="index, follow" />
<meta name="rating" content="safe for kids" />
<meta name="googlebot" content=" index, follow" />
<meta name="allow-search" content="yes" />
<meta name="revisit-after" content="daily" />
<meta name="language" content="en-US" />
<meta name="distribution" content="global" />
<link rel="canonical" href="<?php echo isset($url)?$url:'' ?>" />
<!--<script src="https://www.google.com/recaptcha/api.js?render=6LdmU3YlAAAAAAnC6P746--yNJwaouChyYlVGhka"></script>-->



<!----css files---->

    <link rel="stylesheet" href="<?php echo SITEURL; ?>assets/css/style.css">
