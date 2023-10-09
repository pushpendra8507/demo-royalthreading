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
    <title>About Us, Expert  Beauty Makeover | Parlour in | Queens, NY</title>
    <meta name="description" content="Royal Threading : Discover Expert Beauty Makeovers at Our Queens, NY Parlor. Serving the Greater New York City Area, including Brooklyn, Manhattan, and Queens. Transform your look today!">
    <meta name="keywords" content="Best Eyebrow Makeup Shaping & Waxing in Queens, NY, Best Eyebrow Shaping in Queens, NY, Lash Extension Salon Queens, Eyebrow Waxing Queens">
    <?php include('include/top-header.php');?>
</head>
<body>
    <?php include('include/header.php');?>


    <div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg-2.jpg">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">About Us: Your Expert Beauty Makeover Destination in Queens, NY</h1>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li>About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php $about = $pr_about_us->index(); ?>
    <section class="space-top space-extra-bottom about-us-page-text cmn-text-box">
       
        <div class="container">
            <div class="row justify-content-between gx-0">
                <div class="col-md-12">
                    <!-- <h2>Discover Our Passion for Beauty and Excellence</h2> -->
                    <p><?php echo isset($about['title'])? $about['title']: '' ?></p>        
                    
                </div>
           
            </div>
            <div class="vs-carousel mb-30 pb-1 wow fadeInUp" data-wow-delay="0.2s" data-fade="true">
                <div><img src="<?php echo isset($about['photourl_1'])? $about['photourl_1']: '' ?>" alt="Best Eyebrow Makeup Shaping & Waxing in Queens, NY" class="w-100"></div>
                <div><img src="<?php echo isset($about['photourl_2'])? $about['photourl_2']: '' ?>" alt="Best Eyebrow Shaping in Queens, NY" class="w-100"></div>
                <div><img src="<?php echo isset($about['photourl_3'])? $about['photourl_3']: '' ?>" alt="Lash Extension Salon Queens, Eyebrow Waxing Queens" class="w-100"></div>
            </div>
            <!-- <h3> We serve following Areas:</h3> -->
            <!-- <h5>Manhattan: </h5> -->
            <p><?php echo isset($about['description'])? $about['description']: '' ?></p>
        </div>
    </section>
    


    <?php include('include/footer.php');?>
</body>

</html>