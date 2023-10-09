<?php
include('classes/startup.php');
$mv_blog = new MV_Blog;
$blog_data = $mv_blog->index_limit();


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

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Blogs | Eyelash Extensions Removal Brooklyn, Queens, NY</title>
    <meta name="description"
        content="Royal Threading Center provides blog-related Eyelash Extensions Removal, threading, waxing, facials, and many more services in Brooklyn, Queens, New York and surrounding areas. Visit the blog page!">
    <meta name="keywords"
        content="Brazilian Wax, Threading Salon Queens, Eyelash Extensions Removal Queens, Mink Lash Extension Brooklyn, Eyelash Extensions Removal Brooklyn, Best Facial Services Brooklyn, Lash Studio Brooklyn">
    <?php include('include/top-header.php');?>

</head>

<body>
    <?php include('include/header.php');?>

<div class="seo-none">
    <h1>Royal Threading Center Blogs</h1>
</div>

        <section class="vs-blog-wrapper space-top space-extra-bottom">
            <div class="container">
                <div class="row gx-50">
                    <div class="col-lg-8 col-md-12 col-xxl-9">
                        <div class="row">
                            <?php foreach($blog_data as $data){ ?>
                            <div class="col-lg-6 col-md-6">
                                <div class="vs-blog has-post-thumbnail">
                                    <div class="blog-img"><a href="<?php if (strstr($_SERVER['PHP_SELF'], $data['alias'])) {
                                                        echo "active";
                                                    } ?>">
                                            <a href="<?php echo SITEURL; ?><?php echo isset($data['alias']) ? $data['alias'] : '' ?>"><img
                                                src="<?php echo isset($data['photourl']) ? $data['photourl'] : '' ?>" alt="Brazilian Wax"></a></div>
                                    <div class="blog-content">
                                        <div class="blog-category">
                                            <button type="button" class="vs-btn style2 d-xl-inline-block"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <?php echo isset($data['name']) ? $data['name'] : '' ?>
                                            </button>
                                        </div>
                                        <h2 class="blog-title"><a href="<?php if (strstr($_SERVER['PHP_SELF'], $data['alias'])) {
                                                        echo "active";
                                                    } ?>">
                                            <a href="<?php echo SITEURL; ?><?php echo isset($data['alias']) ? $data['alias'] : '' ?>"><?php echo isset($data['title'])? $data['title']: '' ?></a>
                                        </h2>
                                        <div class="blog-meta"><a href="<?php echo SITEURL; ?><?php echo isset($data['alias']) ? $data['alias'] : '' ?>"><i class="fas fa-user"></i>by
                                                Dalljiet Kaur</a> <a href="<?php echo SITEURL; ?><?php echo isset($data['alias']) ? $data['alias'] : '' ?>"><i
                                                    class="fas fa-calendar-alt"></i><?php echo isset($data['date'])? $data['date']: '' ?></a> <a href="<?php echo SITEURL; ?><?php echo isset($data['alias']) ? $data['alias'] : '' ?>"><i class="far fa-comments"></i>0
                                                comments</a></div>

                                    </div>
                                </div>
                            </div>
                           

                            <?php } ?>
                        </div>
                </div>
                <?php include('include/blog-sidebar.php');?>
                </div>
            </div>
        </section>
        <?php include('include/footer.php');?>
    </body>

    </html>