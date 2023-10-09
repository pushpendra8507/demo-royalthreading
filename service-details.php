<?php
include('classes/startup.php');
$core = new Core;
$pb_services = new MV_Services;

if (!isset($_REQUEST['detail']) || empty($_REQUEST['detail'])) {
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
<?php $service_seo = $pb_services->get_details_by_alias($_REQUEST['detail']); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Eyebrow, Threading Near me in Queens NY | <?php echo isset($service_seo['seo_title']) ? $service_seo['seo_title'] : '' ?></title>
    <meta name="description" content="<?php echo isset($service_seo['seo_description']) ? $service_seo['seo_description'] : '' ?>">
    <meta name="keywords" content="<?php echo isset($service_seo['seo_keyword']) ? $service_seo['seo_keyword'] : '' ?>">
    <?php include('include/top-header.php'); ?>
</head>
<body>
    <?php include('include/header.php'); ?>
    <?php $service_details = $pb_services->get_details_by_alias($_REQUEST['detail']); ?>
    <div class="breadcumb-wrapper" data-bg-src="<?php echo SITEURL ?><?php echo $service_details['photourl_1']?>">
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"><?php echo isset($service_seo['seo_h1']) ? $service_seo['seo_h1'] : '' ?></h1>
                <h2 class="hide"><?php echo isset($service_seo['seo_h2']) ? $service_seo['seo_h2'] : '' ?></h2>
                <div class="breadcumb-menu-wrap">
                    <ul class="breadcumb-menu">
                        <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                        <li><?php echo isset($service_details['title']) ? $service_details['title'] : '' ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php $servicePrices = json_decode($service_details['price'], true); ?>
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row flex-row-reverse gx-50">
                <div class="col-lg-8 col-xl mb-30 mb-lg-0">
                <div class="list-style2 price-box mb-5">
                        <h5 class="title-price"><?php echo isset($service_details['title_home'])? $service_details['title_home']: '' ?></h5>
                        <ul class="list-unstyled cmn-price-list">
                        <?php
                        
                            foreach($servicePrices as $dynamicPricing){
                            ?>
                            <li>
                                <p><?php echo isset($dynamicPricing['price'])? $dynamicPricing['price']: '' ?> </p>
                                <strong>
                                    <?php echo isset($dynamicPricing['value_1'])? $dynamicPricing['value_1']: '' ?>                                   
                                    </strong>
                                
                            </li>
                            <?php
                            }?>
                        </ul>
                     
                        <div class="package-btn"><button type="button" class="vs-btn style2 d-none d-xl-inline-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Book Now
                            </button></div>


                    </div>
                    <?php $servicePrice = json_decode($service_details['second_price'], true); ?>

<?php
// Check if there is data for at least one item in the $servicePrice array
$hasData = false;
foreach ($servicePrice as $servicedata) {
    if (!empty($servicedata['second_price']) || !empty($servicedata['value_2'])) {
        $hasData = true;
        break; // Exit the loop as soon as data is found
    }
}
?>

<?php if ($hasData) { ?>
    <div class="list-style2 price-box mt-5 mb-5">
        <h5 class="title-price"><?php echo isset($service_details['title_name']) ? $service_details['title_name'] : ''; ?></h5>
        <ul class="list-unstyled cmn-price-list width-half">
            <?php
            foreach ($servicePrice as $servicedata) {
                if (!empty($servicedata['second_price']) || !empty($servicedata['value_2'])) {
                    ?>
                    <li>
                        <p><?php echo isset($servicedata['second_price']) ? $servicedata['second_price'] : ''; ?></p>
                        <strong><?php echo isset($servicedata['value_2']) ? $servicedata['value_2'] : ''; ?></strong>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <div class="package-btn">
            <button type="button" class="vs-btn style2 d-none d-xl-inline-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Book Now
            </button>
        </div>
    </div>
<?php } ?>



<?php $servicePrice = json_decode($service_details['price_3'], true); ?>

<?php
// Check if there is data for at least one item in the $servicePrice array
$hasData = false;
foreach ($servicePrice as $servicedata) {
    if (!empty($servicedata['price_3']) || !empty($servicedata['value_3'])) {
        $hasData = true;
        break; // Exit the loop as soon as data is found
    }
}
?>
<?php if ($hasData) { ?>
    <div class="list-style2 price-box mt-5 mb-5">
        <h5 class="title-price"><?php echo isset($service_details['title_name_2']) ? $service_details['title_name_2'] : ''; ?></h5>
        <ul class="list-unstyled cmn-price-list width-half">
            <?php
            foreach ($servicePrice as $servicedata) {
                if (!empty($servicedata['price_3']) || !empty($servicedata['value_3'])) {
                    ?>
                    <li>
                        <p><?php echo isset($servicedata['price_3']) ? $servicedata['price_3'] : ''; ?></p>
                        <strong><?php echo isset($servicedata['value_3']) ? $servicedata['value_3'] : ''; ?></strong>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <div class="package-btn">
            <button type="button" class="vs-btn style2 d-none d-xl-inline-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Book Now
            </button>
        </div>
    </div>
<?php } ?>
                   
                    <p><?php echo isset($service_details['description'])? $service_details['description']: '' ?></p>
                </div>
                <?php include('include/sidebar-service.php'); ?>

            </div>
        </div>
    </section>

    <?php include('include/footer.php'); ?>
</body>

</html>