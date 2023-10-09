<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Pricing | Royal Threading Center| Brooklyn, NY</title>
    <meta name="description" content="Pricing- Royal Threading Center offers the price list of threading, waxing, eyelashes, facials, tinting, henna tattoo, and shaping, etc. Book an Appointment!">
    <meta name="keywords" content="Royal Threading Center Pricing Brooklyn, NY ">
    <?php include('include/top-header.php');?>

</head>

<body>
    <?php include('include/header.php');?>


    <div class="breadcumb-wrapper" data-bg-src="<?php echo SITEURL; ?>assets/img/breadcumb/breadcumb-bg-2.jpg">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Pricing</h1>
                <h2 class="hide">Brooklyn, NY Royal Threading Center Pricing</h2>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="#">Home</a></li>
                        <li>Pricing</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 


    <?php include('include/footer.php');?>
</body>

</html>