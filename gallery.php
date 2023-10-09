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
    <title>Gallery | Royal Threading Center| Brooklyn, NY</title>
    <meta name="description" content="We offer high-quality and good-looking, gorgeous images and galleries in Brooklyn, NY, and its surrounding. Visit us for more information.">
    <meta name="keywords" content="Royal Threading Center Gallery Brooklyn, NY">
    <?php include('include/top-header.php');?>

</head>

<body>
    <?php include('include/header.php');?>
    <div class="breadcumb-wrapper" data-bg-src="<?php echo SITEURL; ?>assets/img/breadcumb/breadcumb-bg-3.jpg">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Gallery</h1>
                <h2 class="hide">Royal Threading Center Gallery in Brooklyn, NY</h2>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li>Gallery</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php $gallery_data = $pb_work->index(2); ?>
    <section class="space">
        <div class="container">
            <div class="row gy-gx filter-active">
                <?php foreach($gallery_data  as $data){ ?>
                <div class="col-md-6 col-xxl-auto filter-item">
                    <div class="gallery-style1">
                        <div class="gallery-img"><img src="<?php echo isset($data['photourl'])? $data['photourl']: '' ?>" alt="Body Waxing Queens, Eyebrow Waxing Queens"
                                class="w-100"></div>
                        <div class="gallery-shape" data-overlay="white" data-opacity="9"></div>
                        <div class="gallery-content"><a href="<?php echo isset($data['photourl'])? $data['photourl']: '' ?>"
                                class="gallery-btn popup-image"><i class="fal fa-plus"></i></a>                            
                        </div>
                    </div>
                </div>
                <?php } ?>                
            </div>
        </div>
    </section>


    <?php include('include/footer.php');?>
</body>

</html>