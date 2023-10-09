<?php 
include('classes/startup.php');
$core = new Core;

$mv_blog = new MV_Blog;
$pb_work = new MV_Work;
$pb_services = new MV_Services;
$pr_testimonials = new MV_Testimonials;
$pr_about_us = new MV_AboutUs;
$contactus = new MV_Contactus;

$contact = $contactus->index();
$service_data  =  $pb_services->index(2);
?>
 
 
 
 
 
 <div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center"><button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo"><a href="<?php echo SITEURL; ?>"><img src="<?php echo SITEURL; ?>assets/img/logo.webp"  width="260" height="141" alt="facials or lash extension services"></a></div>
        <div class="vs-mobile-menu">
            <ul>
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li class="menu-item-has-children"><a href="<?php echo SITEURL; ?>service.php">Service</a>
                    <ul class="sub-menu">
                    <?php foreach($service_data as $service) { ?>
                                        <li class="<?php if(strstr($_SERVER['PHP_SELF'], $service['detail'])){echo "active";} ?>">
                                            <a href="<?php echo SITEURL.'service/'.$service['detail']; ?>"><?php echo isset($service['title'])?$service['title']:'' ?>
                                            <span class="icon-right-arrow-2"></span>
                                            </a>                          
                                        </li>
                                        <?php } ?>
                    </ul>
                </li>
                <li><a href="<?php echo SITEURL; ?>pricing.php">Pricing</a></li>
                <li><a href="<?php echo SITEURL; ?>about-us.php">About Us</a></li>
                <li><a href="<?php echo SITEURL; ?>gallery.php">Gallery</a></li>
                <li><a href="<?php echo SITEURL; ?>blogs.php">Blogs</a></li>
                <li><a href="<?php echo SITEURL; ?>booknow.php">Book Now</a></li>
            </ul>
        </div>
    </div>
</div>


<header class="vs-header header-layout1">
    <div class="header-top">
        <div class="container">
            <div class="row justify-content-center justify-content-md-between align-items-center">
                <div class="col-auto text-center py-2 py-md-0">
                    <div class="header-links style-white">
                        <ul>
                            <li class="d-none d-xxl-inline-block">
                                <i class="far fa-map-marker-alt"></i>
                                <a href="https://goo.gl/maps/qm4ecLa3hnodYwK56" target="_blank"> 3155 Fulton St,
                                    Brooklyn, NY 11208</a>
                            </li>
                            <li><i class="far fa-phone-alt"></i><a href="tel:<?php echo isset($contact['phone'])?$contact['phone']: '' ?>"><?php echo isset($contact['phone'])?$contact['phone']: '' ?> </a></li>
                            <li><i class="far fa-phone-alt"></i><a href="tel:<?php echo isset($contact['phone_2'])?$contact['phone_2']: '' ?>"><?php echo isset($contact['phone_2'])?$contact['phone_2']: '' ?> (for Mink
                                    lashes only) </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto d-none d-md-block">
                    <div class="social-style1">
                        <a target="_blank" href="<?php echo isset($contact['facebook'])?$contact['facebook']: '' ?>"><i
                                class="fab fa-facebook-f"></i></a>
                                
                                 <a href="https://youtu.be/WhwRKr-WqTg" target="_blank"><i
                                class="fab fa-youtube"></i></a>    
                        <a href="<?php echo isset($contact['yelp'])?$contact['yelp']: '' ?>" target="_blank"><i
                                class="fab fa-yelp"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-wrap">
        <div class="sticky-active">
            <div class="container">
                <div class="row justify-content-between align-items-center gx-60">
                    <div class="col">
                        <div class="header-logo"><a href="<?php echo SITEURL; ?>"><img src="<?php echo SITEURL; ?>assets/img/logo.webp" width="260" height="141" alt="Schedule your appointment today!"></a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <nav class="main-menu menu-style1 d-none d-lg-block">
                            <ul>
                                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                                <li class="menu-item-has-children"><a href="service.php">Service</a>
                                    <ul class="sub-menu">
                                    <?php foreach($service_data as $service) { ?>
                                        <li class="<?php if(strstr($_SERVER['PHP_SELF'], $service['detail'])){echo "active";} ?>">
                                            <a href="<?php echo SITEURL.'service/'.$service['detail']; ?>"><?php echo isset($service['title'])?$service['title']:'' ?>
                                            <span class="icon-right-arrow-2"></span>
                                            </a>                          
                                        </li>
                                        <?php } ?> 
                                    </ul>
                                </li>
               
                                <!-- <li><a href="pricing.php">Pricing</a></li> -->
                                <li><a href="<?php echo SITEURL; ?>about-us.php">About Us</a></li>
                                <li><a href="<?php echo SITEURL; ?>gallery.php">Gallery</a></li>
                                <li><a href="<?php echo SITEURL; ?>blogs.php">Blogs</a></li>
                                <li><a href="<?php echo SITEURL; ?>booknow.php">Book Now</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-auto">
                        <div class="header-btns">
                          <!-- <a href="booknow.php" class="vs-btn style2 d-xl-inline-block">Book Now</a> -->
                          <button type="button" class="vs-btn style2 d-xl-inline-block" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Appointment
                            </button>
                            <button class="vs-menu-toggle d-inline-block d-lg-none" type="button"><i
                                    class="fal fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

