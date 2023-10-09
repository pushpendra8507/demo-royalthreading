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
    <title>Royal Threading Center | Eyebrow Threading & Tinting in Queens, NY</title>
    <meta name="description" content="Select Royal Threading Center beauty for eyebrow threading & Tinting in Queens, NY. Book now.">
    <meta name="keywords" content="Eyebrow Threading Queens, Threading Salon Queens, Eyelash Tinting Queens, Eyebrow Threading and Tinting in Queens, NY, Eyebrow Threading Salons in Queens, NY, Queens Eyebrow Threading Specialist, threading salon near me, threading near me, eyebrow threading near me">
    <?php include('include/top-header.php'); ?>
</head>

<body>
    <?php include('include/header.php'); ?>

    <div class="breadcumb-wrapper" data-bg-src="<?php echo SITEURL; ?>assets/img/breadcumb/royal-threading.jpg">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">THREADING</h1>
                <h2 class="hide">face threading near me</h2>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li>Threading</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row flex-row-reverse gx-50">
                <div class="col-lg-8 col-xl mb-30 mb-lg-0">
                    <div class="list-style2 price-box mb-5">
                        <ul class="list-unstyled cmn-price-list">
                            <li>
                                <p>Eyebrow </p><strong>$7</strong>
                            </li>
                            <li>
                                <p>Lip </p><strong>$5</strong>
                            </li>
                            <li>
                                <p>Lower Lip </p><strong>$3</strong>
                            </li>
                            <li>
                                <p>Chin </p><strong>$6</strong>
                            </li>
                            <li>
                                <p>Neck </p><strong>$6</strong>
                            </li>
                            <li>
                                <p>Nose </p><strong>$5</strong>
                            </li>
                            <li>
                                <p>Nostrill </p><strong>$10</strong>
                            </li>
                            <li>
                                <p>Sides </p><strong>$10</strong>
                            </li>
                            <li>
                                <p>Forehead </p><strong>$5</strong>
                            </li>
                            <li>
                                <p>Full Face </p><strong>$32</strong>
                            </li>
                        </ul>
                        <a href="<?php echo SITEURL; ?>Booknow.php" class="vs-btn style2 d-none d-xl-inline-block">Book Now</a>
                    </div>
                    <h3 class="text-uppercase">Threading </h3>
                    <p>If not defined properly, a person’s eyebrows can completely make one lose one’s good appearance. So that you never face this problem, only put your trust in the number one salon in the Brooklyn, NY region, Royal Threading. Our skilled beauticians study the features of your face and then carry out the necessary trimming and styling. It is our service of threading that sets us apart from all other parlors in this field.</p>


                </div>
                <div class="col-lg-4 col-xl-auto">


                    <?php include('include/sidebar-service.php'); ?>

                </div>
            </div>
        </div>
    </section>


    <?php include('include/footer.php'); ?>
</body>

</html>