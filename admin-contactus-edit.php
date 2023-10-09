<?php
include_once '../classes/startup.php';
$core = new Core;
$contactus = new MV_Contactus;

if (!isset($_SESSION[ADMIN_SESSION])){
    header('location:index.php');die();
}

if (isset($_POST['btn_submit'])) {
 if ($core->verify_token($_POST['token']) == 'yes') {

  $data['address'] = (isset($_POST['address']) && !empty($_POST['address']))? $core->sanetize($_POST['address']):'';
  $data['email'] = (isset($_POST['email']) && !empty($_POST['email']))? $core->sanetize($_POST['email']):'';
  $data['phone'] = (isset($_POST['phone']) && !empty($_POST['phone']))? $core->sanetize($_POST['phone']):'';
  $data['phone_2'] = (isset($_POST['phone_2']) && !empty($_POST['phone_2']))? $core->sanetize($_POST['phone_2']):'';
  $data['facebook'] = (isset($_POST['facebook']) && !empty($_POST['facebook']))? $core->sanetize($_POST['facebook']):'';
  $data['yelp'] = (isset($_POST['yelp']) && !empty($_POST['yelp']))? $core->sanetize($_POST['yelp']):'';

//     $business_hours = array();
//     foreach($_POST['prize'] as $value){
//     $business_hours[$value]['prize'] = $value;
//     $business_hours[$key]['value_1'] = $_POST['value_1'];
    
  
// }

// $data['prize'] = json_encode($business_hours, true);


$update_id = $contactus->update($data);

if($update_id>0){
    $_SESSION['status'] = "Contact Us Updated successfully";
    $_SESSION['icon'] = "success";
    $_SESSION['Page_URL']= "admin-contactus.php";
}
else{
    $_SESSION['status'] = "Contact Us not Updated";
    $_SESSION['icon'] = "error";
    $_SESSION['Page_URL']= "admin-contactus.php";
}
} 
else {
    $_SESSION['status'] = "You are not permited to access";
    $_SESSION['icon'] = "error";
    $_SESSION['Page_URL']= "admin-contactus.php";
}
}

$details = $contactus->index();

$business_hoursArr = isset($details['prize'])?json_decode($details['prize'], true) : "";

$page_name  = 'Contactus';
include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>   
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="admin-contactus.php" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                    Edit Contact Us
                </div>
                <div class="panel-body">
                    <form method="post" enctype="multipart/form-data" action="">
                        <input type="hidden" value="<?php echo $core->csrf_token() ?>" name="token">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="inputEmail3">Address</label>
                                <input name="address" class="form-control" required="" value="<?php echo isset($details['address'])? stripslashes($details['address']) : ""; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="inputEmail3">Email </label>
                                <input type="text" name="email" value="<?php echo isset($details['email'])? stripslashes($details['email']) : ""; ?>" class="form-control" id="inputEmail3" placeholder="Email" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="inputEmail3">Phone 1</label>
                                <input type="text" name="phone" value="<?php echo isset($details['phone'])? stripslashes($details['phone']) : ""; ?>" class="form-control" id="inputEmail3" placeholder="Phone" required="">
                            </div>
                            <div class="col-sm-6">
                                <label for="inputEmail3">Phone 2</label>
                                <input type="text" name="phone_2" value="<?php echo isset($details['phone_2'])? stripslashes($details['phone_2']) : ""; ?>" class="form-control" id="inputEmail3" placeholder="Phone_2" required="">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="inputEmail3">Facebook</label>
                                <input type="text" name="facebook" value="<?php echo isset($details['facebook'])? stripslashes($details['facebook']) : ""; ?>" class="form-control" id="inputEmail3" placeholder="Facebook Link">
                            </div>
                            <div class="col-sm-6">
                                <label for="inputEmail3">Yelp</label>
                                <input type="text" name="yelp" value="<?php echo isset($details['yelp'])? stripslashes($details['yelp']) : ""; ?>" class="form-control" id="inputEmail3" placeholder="Yelp Link">
                            </div>
                        </div>

                        <!-- <div class="form-group row" id="prize">
                            <label for="inputEmail3" class="col-sm-12 col-form-label"> Working Hours </label>
                            <?php if(!empty($business_hoursArr)){
                                $cnt =1;
                                foreach ($business_hoursArr as $value) {
                                    ?>
                                     <div class="col-md-10 item">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="prize[]" value="<?php echo $value['prize'] ?>" required="" class="form-control">
                                            </div>
                                        </div> 
                                         <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="value_1[]" value="<?php echo $value['value_1'] ?>" class="form-control">
                                        </div>
                                    </div> 
                                    
                                        <?php if($cnt == 1){  ?>
                                            <button type="button" id="addbtn" class="btn btn-primary"><span class="fa fa-plus"></span></button>
                                            <?php
                                        }
                                        else
                                        { 
                                        ?>
                                            <button class="btn btn-danger delbtn" ><span class="fa fa-trash"></span>
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $cnt++;
                                }
                            }
                            else
                            {
                                ?>
                                <div class="col-md-10 item">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="prize[]" required="" class="form-control">
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
    <script type="text/javascript">
        var stmax_fields = 7; //maximum input boxes allowed
        var store_time = $("#prize"); //Fields wrapper
        var stadd_button = $("#addbtn"); //Add button ID

        var x = 1; //initlal text box count
        $(stadd_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < stmax_fields) { //max input box allowed
                x++; //text box increment
                $(store_time).append('<div class="col-md-10 item"><div class="col-md-3"><div class="form-group"><input type="text" name="prize[]" required="" class="form-control"> </div></div><div class="col-md-2"><div class="form-group"><input type="text" name="value_1[]" class="form-control"></div></div><button class="btn btn-danger delbtn" ><span class="fa fa-trash"></span></button> </div>'); //add input box
            }
        });

        $(store_time).on("click", ".delbtn", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    </script>





</body>
</html>