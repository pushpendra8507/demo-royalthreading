 
  
  <?php $contact = $contactus->index(); ?>
   <footer class="footer-wrapper footer-layout1">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="social-style2">
                        <a href="<?php echo isset($contact['facebook'])? $contact['facebook']: '' ?>" target="_blank"><i
                                class="fab fa-facebook-f"></i></a>
                                
                            <a href="https://youtu.be/WhwRKr-WqTg" target="_blank"><i
                                class="fab fa-youtube"></i></a>    
                                
                                
                        <a href="<?php echo isset($contact['yelp'])? $contact['yelp']: '' ?>" target="_blank"><i
                                class="fab fa-yelp"></i></a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6">
                    <div class="form-style1">
                        <h3 class="form-title">Business Hours</h3>
                        <p class="footer-time">Monday to saturday <span class="time"> 10:00 AM - 7:30 PM</span></p>
                        <p class="footer-time">Sunday <span class="time"> 11:00 AM - 7:00 PM</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="widget-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-md-6 col-xl-auto">
                    <div class="widget footer-widget">
                        <h3 class="widget_title">Contact Information</h3>
                        <p class="footer-info">
                            <a href="https://goo.gl/maps/qm4ecLa3hnodYwK56" target="_blank" class="text-inherit">
                                <i class="fal fa-map-marker-alt text-theme me-2"></i><?php echo isset($contact['address'])? $contact['address']: '' ?>
                            </a><br>
                            <a href="tel:<?php echo isset($contact['phone'])? $core->phone_url($contact['phone']): '' ?>" class="text-inherit">
                                <i class="far fa-phone-alt text-theme me-2"></i><?php echo isset($contact['phone'])? $contact['phone']: '' ?>
                            </a><br>
                            <a class="text-inherit" href="mailto:<?php echo isset($contact['email'])? $contact['email']: '' ?>">
                                <i class="fal fa-envelope text-theme me-2"></i><?php echo isset($contact['email'])? $contact['email']: '' ?>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Quick Links</h3>
                        <div class="menu-all-pages-container footer-menu">
                            <ul class="menu">
                                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                                <li><a href="<?php echo SITEURL; ?>about-us.php">About Us</a></li>
                                <li><a href="<?php echo SITEURL; ?>gallery.php">Gallery</a></li>
                                <li><a href="<?php echo SITEURL; ?>blogs.php">Blogs</a></li>
                                <li><a target="_blank" href="https://booksy.com/en-us/183471_royal-threading-center_eyebrows-lashes_29902_brooklyn">Book Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Our Services</h3>
                        <div class="menu-all-pages-container footer-menu">
                            <ul class="menu">
                            <?php foreach($service_data as $service) { ?>
                                        <li class="<?php if(strstr($_SERVER['PHP_SELF'], $service['alias'])){echo "active";} ?>">
                                            <a href="<?php echo SITEURL.'service/'.$service['detail'] ?>"><?php echo isset($service['title'])?$service['title']:'' ?>
                                            <span class="icon-right-arrow-2"></span>
                                            </a>                          
                                        </li>
                                        <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-auto">
                    <div class="widget widget_nav_menu footer-widget">
                        <h3 class="widget_title">Special offers</h3>
                        <div class="menu-all-pages-container footer-menu">
                            <ul class="menu">
                                <li><a href="<?php echo SITEURL.'service/'.$service['detail'] ?>">Full Body Wax</a></li>
                                <li><a href="<?php echo SITEURL.'service/'.$service['detail'] ?>">Brazilian Wax</a></li>
                                <li><a href="<?php echo SITEURL.'service/'.$service['detail'] ?>">Bikini Line</a></li>
                                <li><a href="<?php echo SITEURL.'service/'.$service['detail'] ?>">Gold Facial</a></li>
                                <li><a href="<?php echo SITEURL.'service/'.$service['detail'] ?>">Deep Cleansing</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="text-center">
                    <p class="copyright-text">Royal Threading Center © 2023. All rights reserved. <br><a
                            href="https://www.wxperts.co/website-development.php" target="_blank">Website
                            Development</a> | <a href="https://www.wxperts.co/" target="_blank">Hosting</a> | <a
                            href="https://www.wxperts.co/search-engine-optimization.php" target="_blank">SEO</a> | <a
                            href="https://www.wxperts.co/digital-marketing.php" target="_blank">Digital
                            Marketing</a><br><a href="https://www.wxperts.co/" target="_blank"><img
                                src="<?php echo SITEURL; ?>assets/img/wxperts_powerdby.jpg" width="93" height="40" alt="wxperts"></a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>



<!-- Button trigger modal -->


<!-- Modal -->
<?php 
include('contact-form.php'); 
?>

<script src="<?php echo SITEURL; ?>assets/js/vendor/jquery-3.6.0.min.js"></script>
<script defer src="<?php echo SITEURL; ?>assets/js/app.min.js"></script>
<script defer src="<?php echo SITEURL; ?>assets/js/main.js"></script>

<script defer src="<?php echo SITEURL; ?>assets/js/lazysizes.min.js"></script>

	<script>
   setTimeout(function(){
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.onload = function() {
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdmU3YlAAAAAAnC6P746--yNJwaouChyYlVGhka', {action: 'homepage'}).then(function(token) {
               document.getElementById("g-token").value = token;
            });
        });
    }
    script.src = "https://www.google.com/recaptcha/api.js?render=6LdmU3YlAAAAAAnC6P746--yNJwaouChyYlVGhka";
    head.appendChild(script);
 }, 5000);
</script>