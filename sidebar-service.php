<?php

$pb_services = new MV_Services;
$services_data = $pb_services->index(2);
?>

<div class="col-lg-4 col-xl-auto">
    <aside>
        <div class="service-box">
            <h3 class="box-title">All Services</h3>
            <ul class="list-unstyled">
                <?php foreach ($service_data as $service) { ?>
                    <li class="<?php if (strstr($_SERVER['PHP_SELF'], $service['detail'])) {
                                    echo "active";
                                } ?>">
                        <a href="<?php echo SITEURL.'service/'.$service['detail'] ?>"><?php echo isset($service['title']) ? $service['title'] : '' ?>
                            <span class="icon-right-arrow-2"></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </aside>
</div>
