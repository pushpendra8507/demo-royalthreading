<?php $mv_blog = new MV_Blog;

$all_projects = $mv_blog->index_limit();

?>



<div class="col-lg-4 col-md-12 col-xxl-3">
    <aside class="sidebar-area">
        <div class="widget">
            <h3 class="widget_title">Latest post</h3>
            <?php foreach ($all_projects as $blogs) { ?>
                <div class="recent-post-wrap">
                    <div class="recent-post">
                        <div class="media-img"><a href="<?php echo isset($blogs['alias'])? $blogs['alias']: '' ?>"><img src="<?php echo isset($blogs['photourl']) ? $blogs['photourl'] : '' ?>" alt="Threading Salon Queens"></a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title"><a class="text-inherit" href="<?php echo SITEURL; ?><?php echo isset($blogs['alias']) ? $blogs['alias'] : '' ?>"><?php echo isset($blogs['title'])? $blogs['title']: ''  ?></a></h4>
                            <div class="recent-post-meta"><a href="<?php echo SITEURL; ?><?php echo isset($blogs['alias']) ? $blogs['alias'] : '' ?>"><i class="fas fa-calendar-alt"></i><?php echo isset($blogs['date'])? $blogs['date']: ''  ?></a></div>
                        </div>
                    </div>
                </div>

                <!-- <div class="recent-post-wrap">
                    <div class="recent-post">
                        <div class="media-img"><a href="best-facial-services.php"><img src="assets/img/blog/best-facial-services.jpg" alt="Best Facail Services"></a>
                        </div>
                        <div class="media-body">
                            <h4 class="post-title"><a class="text-inherit" href="best-facial-services.php">Best Facial Services</a></h4>
                            <div class="recent-post-meta"><a href="best-facial-services.php"><i class="fas fa-calendar-alt"></i>June 21, 2023</a></div>
                        </div>
                    </div>
                </div> -->

            <?php } ?>

        </div>


    </aside>
</div>