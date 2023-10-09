<?php
include_once '../classes/startup.php';
$core = new Core;
$pr_about_us = new MV_AboutUs;





if (isset($_POST['btn_submit'])) 
{

    $update_id = $pr_about_us->update($_POST);


    
    if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $update_id>0) {
        $path = '../uploads/about-us';
        $core->UploadImage($_FILES['fu_photo'], $path, 'Bk_Royaltherding-'.time().$update_id, 'tbl_aboutus', 'photourl_1', 'id', $update_id);
    }
    if (isset($_FILES['fu_photo1']) && $_FILES['fu_photo1']['name'] != "" && $update_id>0) {
        $path = '../uploads/';
        $core->UploadImage($_FILES['fu_photo1'], $path, 'Bk_Royaltherding-'.time().$update_id, 'tbl_aboutus', 'photourl_2', 'id', $update_id);
    }

    if (isset($_FILES['fu_photo2']) && $_FILES['fu_photo2']['name'] != "" && $update_id>0) {
        $path = '../uploads/about-us';
        $core->UploadImage($_FILES['fu_photo2'], $path, 'Bk_Royaltherding-'.time().$update_id, 'tbl_aboutus', 'photourl_3', 'id', $update_id);
    }

    // if (isset($_FILES['fu_photo3']) && $_FILES['fu_photo3']['name'] != "" && $update_id>0) {
    //     $path = '../uploads/about-us';
    //     $core->UploadImage($_FILES['fu_photo3'], $path, 'Bk_Royaltherding-'.time().$update_id, 'tbl_aboutus', 'photourl_4', 'id', $update_id);
    // }
    

    if($update_id>0){
        $alert_data= array(
            "status"=>"About Us updated",
            "icon"=>"success",
            "page_url"=>"manage_about.php"
        );
    }
    

    else
    {
        $alert_data= array(
            "status"=>"About Us updated",
            "icon"=>"success",
            "page_url"=>"manage_about_edit.php"
        );
    }
    $core->set_sweetalert($alert_data);

}

$details = $pr_about_us->index();
// echo print_r($details);

$page = 'About Us';
include("includes/top_header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>	
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="manage_about.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Edit About Us
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <div class="form-group">
                            
                            <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image</label>
                                <input type="file" name="fu_photo" id="image" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage" src="<?php echo (!empty($details['photourl_1']))?'../'.$details['photourl_1']:'../upload/no_image.jpg' ?>" /> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image 2</label>
                                <input type="file" name="fu_photo1" id="image1" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage1" src="<?php echo (!empty($details['photourl_2']))?'../'.$details['photourl_2']:'../upload/' ?>" /> 
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image 3</label>
                                <input type="file" name="fu_photo2" id="image2" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage2" src="<?php echo (!empty($details['photourl_3']))?'../'.$details['photourl_3']:'../upload/' ?>" /> 
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image 4</label>
                                <input type="file" name="fu_photo3" id="image3" />
                                </div> -->
                                <!-- <div class="col-md-6">
                                    <img width="80" id="showImage3" src="<?php echo (!empty($details['photourl_4']))?'../'.$details['photourl_4']:'../upload/' ?>" /> 
                                </div>
                            </div> -->

                                
                               

                          
                            

                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="inputEmail3">Description 1</label>
                                <textarea class="form-control description" name="title" required><?php echo (isset($details['title']))? html_entity_decode($details['title']):'' ?></textarea>
                                
                            </div>


                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="inputEmail3">About Us Description 2</label>
                                <textarea class="form-control description" name="description" required><?php echo (isset($details['description']))? html_entity_decode($details['description']):'' ?></textarea>
                                
                            </div>
                        </div>
                        
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

    <script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image1').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage1').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function(){
		$('#image2').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage2').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#image3').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage3').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>
</body>
</html>