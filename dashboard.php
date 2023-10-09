<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;

$contact_us = new MV_ContactUs;

$page_name = 'Dashboard';

include("includes/top_header.php");

// Fetch data from Database
$contactus_data = $contact_us->index();
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>
                <div class="panel-body">
                <div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<img src="../assets/img/logo.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="300" style="margin:30px; border-radius:15px;">
											<!-- <div class="mt-3">
												<h4>John Doe</h4>
												<p class="text-secondary mb-1">Full Stack Developer</p>
												<p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
												<button class="btn btn-primary">Follow</button>
												<button class="btn btn-outline-primary">Message</button>
											</div> -->
										</div>
									
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Site Url</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="<?php echo SITEURL; ?>?" disabled>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Email</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="<?php echo isset($contactus_data['email'])?$contactus_data['email']: ''?>" disabled>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Phone</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="<?php echo isset($contactus_data['phone'])?$contactus_data['phone']:'' ?>" disabled>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-3">
												<h6 class="mb-0">Address</h6>
											</div>
											<div class="col-sm-9 text-secondary">
												<input type="text" class="form-control" value="<?php echo isset($contactus_data['address'])?$contactus_data['address']:'' ?>" disabled>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>
                </div>

            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>

    <script>
        $(function () {
            $('.navbar-toggle-sidebar').click(function () {
                $('.navbar-nav').toggleClass('slide-in');
                $('.side-body').toggleClass('body-slide-in');
                $('#search').removeClass('in').addClass('collapse').slideUp(200);
            });

            $('#search-trigger').click(function () {
                $('.navbar-nav').removeClass('slide-in');
                $('.side-body').removeClass('body-slide-in');
                $('.search-input').focus();
            });
        });
    </script>
</body>

</html>