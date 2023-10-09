<?php
include_once '../classes/startup.php';
$core = new Core;
$contactus = new MV_Contactus;

if (!isset($_SESSION[ADMIN_SESSION])){
  header('location:index.php');die();
}

$contact = $contactus->index();
$business_hours = isset($contact['business_hours'])? json_decode($contact['business_hours'], true) : "";

$page_name  = 'Contactus';
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
          Manage Contact Us
          <a href="admin-contactus-edit.php" title="Edit" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none; font-weight: bold;">Edit</a> 
        </div>

        <div class="panel-body">
          <table class="table table-dark contact">
           
            <tr>
              <td>Email:</td>
              <td><?php echo $contact['email'] ?></td>
            </tr>
            <tr>
              <td>Phone 1:</td>
              <td><?php echo $contact['phone'] ?></td>
            </tr>
            <tr>
              <td>Phone 2:</td>
              <td><?php echo $contact['phone_2'] ?></td>
            </tr>
            <tr>
              <td>Facebook:</td>
              <td><?php echo $contact['facebook'] ?></td>
            </tr>
            <tr>
              <td>Yelp:</td>
              <td><?php echo $contact['yelp'] ?></td>
            </tr>
            <tr>
              <td>Address:</td>
              <td><?php echo $contact['address'] ?></td>
            </tr>
            
          </table>
        </div>
      </div>
    </div>
    <?php include("includes/footer.php"); ?>
  </div> 
</body>
</html>