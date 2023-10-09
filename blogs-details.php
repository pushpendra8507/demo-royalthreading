<?php
include('classes/startup.php');
$core =    new Core;
$mv_blog = new MV_Blog;

if (!isset($_REQUEST['alias']) || empty($_REQUEST['alias'])) {
    header('location:index.php');
    exit;
}

?>



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
<?php $blogs_seo = $mv_blog->get_details_by_alias($_REQUEST['alias']);   ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Blogs | Royal Threading Center | <?php echo isset($blogs_seo['seo_title']) ? $blogs_seo['seo_title'] : '' ?></title>
    <meta name="description" content="<?php echo isset($blogs_seo['seo_description']) ? $blogs_seo['seo_description'] : '' ?>">
    <meta name="keywords" content="<?php echo isset($blogs_seo['seo_keyword']) ? $blogs_seo['seo_keyword'] : '' ?>">
    <?php include('include/top-header.php'); ?>

    <!--tooltip code!--->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!--tooltip code!--->

    <!--share code!--->
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=6442ef8cb4717c0019327d3d&product=inline-share-buttons' async='async'></script>
    <!--share code!--->
</head>

<body>
    <?php include('include/header.php'); ?>

    <div class="seo-none">
        <h1><?php echo isset($blogs_seo['seo_h1']) ? $blogs_seo['seo_h1'] : '' ?></h1>
    </div>
    <?php $blog_details = $mv_blog->get_details_by_alias($_REQUEST['alias']);     ?>
    <section class="vs-blog-wrapper blog-details space-top space-extra-bottom">
        <div class="container">
            <div class="row gx-50">
                <div class="col-lg-8 col-xxl-9">
                    <div class="vs-blog blog-single">
                    <?php
if (isset($blog_details['photourl'])) {
    // If photourl is set, display the image
    echo '<div class="blog-img"><img src="' . $blog_details['photourl'] . '" alt="eyelash extensions"></div>';
} elseif (isset($blog_details['link'])) {
    // If link is set, display the video
    echo '<div class="blog-img">
            <video autoplay="autoplay" id="movie" loop="loop" muted="muted" playsinline="playsinline" preload="preload" style="width:100%;">
                <source id="srcMp4" src="assets/img/' . $blog_details['link'] . '" type="video/mp4"> 
            </video>
          </div>';
} else {
    // Display a default message or alternative content
    echo '<div class="default-content">No media available.</div>';
}
?>


                        <div class="blog-content">
                            <h2 class="blog-title"><?php echo isset($blogs_seo['seo_h2']) ? $blogs_seo['seo_h2'] : '' ?></h2>
                            <div class="blog-meta"><a href="#"><i class="fas fa-user"></i>by Dalljiet Kaur</a> 
                            <?php echo isset($blog_details['date']) ? $blog_details['date'] : ''  ?></a> <a href="#"><i class="far fa-comments"></i>0 comments</a></div>
                            <p><?php echo isset($blog_details['description']) ? $blog_details['description'] : ''  ?></p>
                            <a href="<?php echo SITEURL; ?>booknow.php" class="vs-btn style2 d-xl-inline-block">Book Now</a>
                        </div>
                        <div class="share-links clearfix">
                            <div class="row justify-content-between">
                                <div class="col-md-auto"><span class="share-links-title">Tags:</span>
                                    <div class="tagcloud">
                                        <p><?php echo isset($blog_details['tags']) ? $blog_details['tags'] : ''  ?></p>
                                    </div>
                                </div>
                                <!--share code!--->
                                <div class="col-md-3 text-xl-end">
                                    <!-- ShareThis BEGIN -->
                                    <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->

                                </div>

                                <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.royalthreadings.com%2F&width=450&layout&action&size&share=true&height=35&appId" width="450" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                <!--share code!--->

                            </div>
                        </div>
                        <div class="post-pagination">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <div class="post-pagi-box prev"><a href="#"><i class="fas fa-angle-double-left"></i>Prev Post</a></div>
                                </div>
                                <div class="col-auto d-none d-sm-block"><a href="#" class="pagi-icon"><i class="flaticon-menu-1 fa-3x"></i></a></div>
                                <div class="col">
                                    <div class="post-pagi-box next"><a href="#"><i class="fas fa-angle-double-right"></i>Next Post</a></div>
                                </div>
                            </div>
                        </div>


                        <?php include('include/blog-form.php'); ?>



                    </div>
                </div>


                <?php include('include/blog-sidebar.php'); ?>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <?php include('include/footer.php'); ?>
</body>

</html>