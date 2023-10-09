<?php
session_start();
include_once '../classes/startup.php';
if(isset($_SESSION[ADMIN_SESSION]))
{
	unset($_SESSION[ADMIN_SESSION]);
}
if(isset($_SESSION[ADMIN_SESSION_EMAIL]))
{
	unset($_SESSION[ADMIN_SESSION_EMAIL]);
}

header('location:index.php');
?>

