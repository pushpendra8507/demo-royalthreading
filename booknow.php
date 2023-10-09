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
    <title>Booknow | Eyebrow Threading Brooklyn |Royal Threading Center</title>
    <meta name="description"
        content="Royal Threading Center - Book an appointment for eyebrow threading, eyelash Extensions Removal, waxing, facials, and many more services in Brooklyn, Queens, New York. Book todays!">
    <meta name="keywords"
        content="Online Eyebrow Threading in Brooklyn, NY, Eyelash Extension Removal in Brooklyn, NY, Book Facial Services in Brooklyn, NY, Online Henna Tattoo in Brooklyn, NY">
    <?php include('include/top-header.php');?>

</head>

<body>
    <?php include('include/header.php');?>



        <section class="booknow-sec space-top space-extra-bottom">
            <div class="container">
                <div class="row gx-50">
                    <div class="col-lg-6 col-md-6 mx-auto">
                       <h1 class="hide">Online Eyebrow Threading Brooklyn, NY</h1>
                    <h2 class="hide">Brooklyn Online Eyebrow Threading </h2>
                       <script src="https://widgets.mindbodyonline.com/javascripts/healcode.js" type="text/javascript"></script>
                        <healcode-widget data-type="appointments" data-widget-partner="object" data-widget-id="1f1050880b49" data-widget-version="0" ></healcode-widget>

                    </div>
               
                </div>
            </div>
        </section>
        <?php include('include/footer.php');?>
    </body>

    </html>