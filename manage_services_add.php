<?php
include_once '../classes/startup.php';
if (!isset($_SESSION[ADMIN_SESSION])) {
    header('location:index.php');
}
$core = new Core;
$pb_services = new MV_Services;


if (isset($_POST['btn_submit'])) {
    $data['title'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $_POST['title'] : '';
    $data['detail'] = (isset($_POST['title']) && !empty($_POST['title'])) ? $core->alias_url($_POST['title']) : '';
    $data['seo_title'] = (isset($_POST['seo_title']) && !empty($_POST['seo_title'])) ? ($_POST['seo_title']) : '';
    $data['title_home'] = (isset($_POST['title_home']) && !empty($_POST['title_home'])) ?($_POST['title_home']) : '';
    $data['seo_description'] = (isset($_POST['seo_description']) && !empty($_POST['seo_description'])) ? $core->alias_url($_POST['seo_description']) : '';
    $data['seo_keyword'] = (isset($_POST['seo_keyword']) && !empty($_POST['seo_keyword'])) ? ($_POST['seo_keyword']) : '';
    $data['seo_h1'] = (isset($_POST['seo_h1']) && !empty($_POST['seo_h1'])) ? ($_POST['seo_h1']) : '';
    $data['seo_h2'] = (isset($_POST['seo_h2']) && !empty($_POST['seo_h2'])) ? ($_POST['seo_h2']) : '';
    $data['description'] = (isset($_POST['description']) && !empty($_POST['description'])) ? $_POST['description'] : '';
    $data['alt_name'] = (isset($_POST['alt_name']) && !empty($_POST['alt_name'])) ? $_POST['alt_name'] : '';
    $data['title_name'] = (isset($_POST['title_name']) && !empty($_POST['title_name'])) ? $_POST['title_name'] : '';
    $data['title_name_2'] = (isset($_POST['title_name_2']) && !empty($_POST['title_name_2'])) ? $_POST['title_name_2'] : '';
    
     $price = array();
          foreach($_POST['price'] as $key=>$value){
            $price[$key]['price'] = $value;
            $price[$key]['value_1'] = $_POST['value_1'][$key];
           
        }

        $data['price'] = json_encode($price, true);

        $second_price = array();
        foreach($_POST['second_price'] as $key=>$value){
          $second_price[$key]['second_price'] = $value;
          $second_price[$key]['value_2'] = $_POST['value_2'][$key];
         
      }

      $data['second_price'] = json_encode($second_price, true);




      
      $price_3 = array();
      foreach($_POST['price_3'] as $key=>$value){
        $price_3[$key]['price_3'] = $value;
        $price_3[$key]['value_3'] = $_POST['value_3'][$key];
       
    }

    $data['price_3'] = json_encode($price_3, true);

  
    



    if (empty($_POST['status'])) {
        $last_insert_id = $pb_services->store($data);
    } else {
        $last_insert_id = $pb_services->update($_POST['status'], $data);
    }

    if (isset($_FILES['fu_photo']) && $_FILES['fu_photo']['name'] != "" && $last_insert_id > 0) {
        $path = '../uploads/service';
        $core->UploadImage($_FILES['fu_photo'], $path, 'royalthreading' . time() . $last_insert_id, 'tbl_services', 'photourl', 'id', $last_insert_id);
    }

    if (isset($_FILES['fu_photo_home']) && $_FILES['fu_photo_home']['name'] != "" && $last_insert_id > 0) {
        $path = '../uploads/';
        $core->UploadImage($_FILES['fu_photo_home'], $path, 'royalthreading' . time() . $last_insert_id, 'tbl_services', 'photourl_1', 'id', $last_insert_id);
    }

    if ($last_insert_id > 0) {
        if (!empty($_POST['status'])) {
            $alert_data = array(
                "status" => "Record Updated",
                "icon" => "success",
                "page_url" => "manage_services.php"
            );
        } else {
            $alert_data = array(
                "status" => "Record Added",
                "icon" => "success",
                "page_url" => "manage_services_add.php"
            );
        }
    } else {
        $alert_data = array(
            "status" => "something went wrong",
            "icon" => "error",
            "page_url" => "manage_services.php"
        );
    }
    $core->set_sweetalert($alert_data);
}

if (isset($_REQUEST["eid"])) {
    $details = $pb_services->get_details($_REQUEST["eid"]);
}
 
$priceArr = isset($details['price']) ? json_decode($details['price'], true) : "";
 
$second_priceArr = isset($details['second_price']) ? json_decode($details['second_price'], true) : "";

$price_3 = isset($details['price_3']) ? json_decode($details['price_3'], true) : "";



// print_r($priceArr);

$page_name = 'Services';

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
                    <a href="manage_services.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    <?php echo isset($_REQUEST['eid']) ? "Edit" : "Add"; ?>
                    Services
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" name="status" value="<?php echo (isset($_REQUEST['eid'])) ? $_REQUEST['eid'] : ""; ?>">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Seo Title </label>
                                    <textarea class="form-control" name="seo_title"><?php echo isset($details['seo_title']) ? html_entity_decode($details['seo_title']) : '' ?></textarea>
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
                                    <label for="inputEmail3"> Title </label>
                                    <input type="text" name="title" value="<?php echo (isset($details['title'])) ? $details['title'] : ''; ?>" required="" class="form-control" id="inputEmail3">
                                </div>
                            </div>
   
                             
                         

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3"> Long Description of Service Page </label>
                                    <textarea class="form-control description" name="description"><?php echo isset($details['description']) ? html_entity_decode($details['description']) : '' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image-Home</label>
                                <input type="file" name="fu_photo" id="image" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage" src="<?php echo (!empty($details['photourl']))?'../'.$details['photourl']:'' ?>" /> 
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                <label for="inputEmail3">Image-service</label>
                                <input type="file" name="fu_photo_home" id="image1" />
                                </div>
                                <div class="col-md-6">
                                    <img width="80" id="showImage1" src="<?php echo (!empty($details['photourl_1']))?'../'.$details['photourl_1']:'' ?>" /> 
                                </div>
                            </div>
                           <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Alt_Name</label>
                                    <input class="form-control  " name="alt_name" value="<?php echo (isset($details['alt_name'])) ? $details['alt_name'] : ''; ?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Service Name</label>
                                    <input class="form-control  " name="title_home" value="<?php echo (isset($details['title_home'])) ? $details['title_home'] : ''; ?>">
                                </div>
                            </div>
                           
 
                          <div class="form-group row" id="price">
                            <label for="inputEmail3" class="col-sm-12 col-form-label"> Price-Data </label>
                            <?php if (!empty($priceArr)) {
                                $cnt = 1;
                                foreach ($priceArr as $value) {
                            ?>
                                    <div class="col-md-10 item">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="price[]" value="<?php echo $value ['price'] ?>"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_1[]" value="<?php echo $value['value_1'] ?>" class="form-control">
                                        </div>
                                    </div>
                                   
                                    
                                        <?php if ($cnt == 1) {  ?>
                                            <button type="button" id="addbtn" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-danger delbtn" ><span class="fa fa-trash"></span>
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $cnt++;
                                }
                            } else {
                                    ?>
                                <div class="col-md-10 item">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="price[]" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_1[]" class="form-control">
                                        </div>
                                    </div>
                                   

                                    <button type="button" id="addbtn" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                </div>
                                <?php
                            }
                                ?>
                        </div> 
                           

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Service Name-2</label>
                                    <input class="form-control  " name="title_name" value="<?php echo (isset($details['title_name'])) ? $details['title_name'] : ''; ?>">
                                </div>
                            </div>



                        <div class="form-group row" id="second_price">
                            <label for="inputEmail3" class="col-sm-12 col-form-label"> second_price-Data </label>
                            <?php if (!empty($second_priceArr)) {
                                $cnt = 1;
                                foreach ($second_priceArr as $value) {
                            ?>
                                    <div class="col-md-10 item">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="second_price[]" value="<?php echo $value ['second_price'] ?>"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_2[]" value="<?php echo $value['value_2'] ?>" class="form-control">
                                        </div>
                                    </div>
                                   
                                    
                                        <?php if ($cnt == 1) {  ?>
                                            <button type="button" id="addbtn_2" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-danger delbtn_2" ><span class="fa fa-trash"></span>
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $cnt++;
                                }
                            } else {
                                    ?>
                                <div class="col-md-10 item">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="second_price[]" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_2[]" class="form-control">
                                        </div>
                                    </div>
                                   

                                    <button type="button" id="addbtn_2" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                </div>
                                <?php
                            }
                                ?>
                        </div> 
                           

                        <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputEmail3">Service Name-3</label>
                                    <input class="form-control  " name="title_name_2" value="<?php echo (isset($details['title_name_2'])) ? $details['title_name_2'] : ''; ?>">
                                </div>
                            </div>
                         

                        <div class="form-group row" id="price_3">
                            <label for="inputEmail3" class="col-sm-12 col-form-label"> Price-Data-3 </label>
                            <?php if (!empty($price_3)) {
                                $cnt = 1;
                                foreach ($price_3 as $value) {
                            ?>
                                    <div class="col-md-10 item">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="price_3[]" value="<?php echo $value ['price_3'] ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_3[]" value="<?php echo $value['value_3'] ?>" class="form-control">
                                        </div>
                                    </div>
                                   
                                    
                                        <?php if ($cnt == 1) {  ?>
                                            <button type="button" id="addbtn_3" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-danger delbtn_3" ><span class="fa fa-trash"></span>
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $cnt++;
                                }
                            } else {
                                    ?>
                                <div class="col-md-10 item">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="price_3[]" required="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_3[]" class="form-control">
                                        </div>
                                    </div>
                                   

                                    <button type="button" id="addbtn_3" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                </div>
                                <?php
                            }
                                ?>
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
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

<script type="text/javascript">
        $(document).ready(function() {
            $('#image1').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage1').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
     
 
     <script type="text/javascript">
        var stmax_fields = Infinity; //maximum input boxes allowed
        var store_time = $("#price"); //Fields wrapper
        var stadd_button = $("#addbtn"); //Add button ID

        var x = 1; //initlal text box count
        $(stadd_button).click(function(m) { //on add input button click
            m.preventDefault();
            if (x < stmax_fields) { //max input box allowed
                x++; //text box increment
                $(store_time).append('<div class="col-md-10 item"><div class="col-md-3"><div class="form-group"><input type="text" name="price[]"  class="form-control"> </div></div><div class="col-md-2"><div class="form-group"><input type="text" name="value_1[]" class="form-control"></div></div><button class="btn btn-danger delbtn" ><span class="fa fa-trash"></span></button> </div>'); //add input box
            }
        });

        $(store_time).on("click", ".delbtn", function(m) { //user click on remove text
            m.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    </script>

      



<script type="text/javascript">
        var stmax_field = Infinity; //maximum input boxes allowed
        var store_tim = $("#second_price"); //Fields wrapper
        var stadd_button = $("#addbtn_2"); //Add button ID

        var x = 1; //initlal text box count
        $(stadd_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < stmax_field) { //max input box allowed
                x++; //text box increment
                $(store_tim).append('<div class="col-md-10 item"><div class="col-md-3"><div class="form-group"><input type="text" name="second_price[]"  class="form-control"> </div></div><div class="col-md-2"><div class="form-group"><input type="text" name="value_2[]" class="form-control"></div></div><button class="btn btn-danger delbtn_2" ><span class="fa fa-trash"></span></button> </div>'); //add input box
            }
        });

        $(store_tim).on("click", ".delbtn_2", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    </script>






<script type="text/javascript">
        var stmax_f = Infinity; //maximum input boxes allowed
        var store_times = $("#price_3"); //Fields wrapper
        var stadd_button = $("#addbtn_3"); //Add button ID

        var x = 1; //initlal text box count
        $(stadd_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < stmax_f) { //max input box allowed
                x++; //text box increment
                $(store_times).append('<div class="col-md-10 item"><div class="col-md-3"><div class="form-group"><input type="text" name="price_3[]"  class="form-control"> </div></div><div class="col-md-2"><div class="form-group"><input type="text" name="value_3[]" class="form-control"></div></div><button class="btn btn-danger delbtn_3" ><span class="fa fa-trash"></span></button> </div>'); //add input box
            }
        });

        $(store_times).on("click", ".delbtn_3", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    </script>
</body>

</html>