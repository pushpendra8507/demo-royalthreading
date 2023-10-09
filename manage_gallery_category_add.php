<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pr_services = new MV_Gallery;


if (isset($_POST['btn_submit'])) {
    $data['title'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
    $data['alias'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $core->alias_url($_POST['title']) : '';
    $data['seo_title'] = (isset($_POST['seo_title']) && !empty($_POST['seo_title'])) ? $core->alias_url($_POST['seo_title']) : '';
    $data['seo_description'] = (isset($_POST['seo_description']) && !empty($_POST['seo_description'])) ? $core->alias_url($_POST['seo_description']) : '';
    $data['seo_keyword'] = (isset($_POST['seo_keyword']) && !empty($_POST['seo_keyword'])) ? $core->alias_url($_POST['seo_keyword']) : '';
    $data['seo_h1'] = (isset($_POST['seo_h1']) && !empty($_POST['seo_h1'])) ? $core->alias_url($_POST['seo_h1']) : '';
    $data['seo_h2'] = (isset($_POST['seo_h2']) && !empty($_POST['seo_h2'])) ? $core->alias_url($_POST['seo_h2']) : '';
    $data['description'] = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : '';
   

    if (empty($_POST['status'])) {
        $last_insert_id = $pr_services->store($data);
    } else {
        $last_insert_id = $pr_services->update($_POST['status'], $data);
    }



    if ($last_insert_id > 0) {
        if (!empty($_POST['status'])) {
            $alert_data = array(
                "status" => "Record Updated",
                "icon" => "success",
                "page_url" => "manage_gallery_category.php"
            );
        } else {
            $alert_data = array(
                "status" => "Record Added",
                "icon" => "success",
                "page_url" => "manage_gallery_category_add.php"
            );
        }
    } else {
        $alert_data = array(
            "status" => "something went wrong",
            "icon" => "error",
            "page_url" => "manage_gallery_category.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST["eid"])) {
    $details = $pr_services->get_details($_REQUEST["eid"]);
}



$page_name = 'Gallery';

include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_gallery_category.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    <?php echo isset($_REQUEST['eid']) ? "Edit" : "Add"; ?>
                    Services
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="status" value="<?php echo (isset($_REQUEST['eid'])) ? $_REQUEST['eid'] : ""; ?>">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Seo Title </label>
                                    <textarea class="form-control" name="seo_title"><?php echo isset($details['seo_title']) ? html_entity_decode($details['seo_title']) : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Title </label>
                                    <input type="text" name="title" value="<?php echo (isset($details['title'])) ? $details['title'] : ''; ?>" required="" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Seo Description </label>
                                    <textarea class="form-control " name="seo_description"><?php echo isset($details['seo_description']) ? html_entity_decode($details['seo_description']) : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Seo Keyword </label>
                                    <textarea class="form-control" name="seo_keyword"><?php echo isset($details['seo_keyword']) ? html_entity_decode($details['seo_keyword']) : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-bottom: 32px;">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="inputEmail3"> Seo H1 </label>
                                        <textarea class="form-control" name="seo_h1"><?php echo isset($details['seo_h1']) ? html_entity_decode($details['seo_h1']) : '' ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail3"> Seo H2 </label>
                                        <textarea class="form-control" name="seo_h2"><?php echo isset($details['seo_h2']) ? html_entity_decode($details['seo_h2']) : '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Long Description of Service Page </label>
                                    <textarea class="form-control description" name="description"><?php echo isset($details['description']) ? html_entity_decode($details['description']) : '' ?></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image</label>
                                <input type="file" name="fu_photo" id="image" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage" src="<?php echo (!empty($details['photourl']))?'../'.$details['photourl']:'' ?>" /> 
                                </div>
                            </div> -->
                         

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="btn_submit" value="SUBMIT" class="btn btn-primary">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>

</body>

</html>