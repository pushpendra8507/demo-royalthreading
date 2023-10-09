<?php
include_once '../classes/startup.php';
$core = new Core;
$appointments = new Appointments;

if (!isset($_SESSION[ADMIN_SESSION])){
    header('location:index.php');die();
}

$page = isset($_GET['page'])? $_GET['page'] : 1;

if(isset($_REQUEST['delete'])){
    $delete = (int)$_REQUEST['delete'];
    if($appointments->deleteAppointment($delete)){
        $msg_title = "Appointment Deleted successfully";
        $msg_icon = "success";
        $page_url = SITEURL."admin/admin-appointments.php?page=".$page;
    }
}

$filter_data = [];
$filter_data['per_page']    = isset($_GET['per_page'])?$_GET['per_page']:'';
$filter_data['from_date']   = isset($_GET['from_date'])?$_GET['from_date']:'';
$filter_data['to_date']     = isset($_GET['to_date'])?$_GET['to_date']:'';

$PaginateIt = new PaginateIt();
$PaginateIt->SetCurrentPage($page);
$per_page = isset($_GET['per_page'])?$_GET['per_page']:10;
$PaginateIt->SetItemsPerPage($per_page);
$PaginateIt->SetLinksToDisplay(10);
$PaginateIt->SetQueryStringVar('page');

$item_count = count($appointments->getAppointmentList($filter_data));
$PaginateIt->SetItemCount($item_count);

$appointment_list = $appointments->getAppointmentList($filter_data,$PaginateIt->GetSqlLimit());
$PaginateIt->SetLinksFormat('←   Prev', ' ', 'Next   →');


function curPageURL() 
{
    $pageURL = 'http';
    if(isset($_SERVER["HTTPS"]))
    if ($_SERVER["HTTPS"] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

$page_name  = 'Appointments';
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
                    All Contact Form
                </div>
                <div class="panel-body">
                <div class="card">
    <div class="table-responsive">
        <div class="row m-2">
            <div class="col-md-6">
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>From Date</label>
                            <input type="date" required value="<?php echo isset($_GET['from_date'])?$_GET['from_date']:'' ?>" name="from_date" placeholder="From Date">
                        </div>
                        <div class="form-group col-md-6">
                            <label>To Date</label>
                            <input type="date" required value="<?php echo isset($_GET['to_date'])?$_GET['to_date']:'' ?>" name="to_date" placeholder="To Date">
                            <input type="submit" class="ml-2" name="btn_filter">
                        </div>
                        
                    </div>
                    
                    
                </form>
                
            </div>
            <div class="col-md-6" style="text-align:right">
               
                <form>
                    <?php
                        if(isset($_GET['from_date']) && isset($_GET['to_date']))
                        {
                        ?>
                            <input type="hidden" name="from_date" value="<?php echo $_GET['from_date'] ?>"/>
                            <input type="hidden" name="to_date" value="<?php echo $_GET['to_date'] ?>"/>
                        <?php
                        }
                    ?>
                    <select name="per_page" onchange="submit();">
                        <option value="10" <?php echo ($per_page==10)?'selected':'' ?>>10</option>
                        <option value="20" <?php echo ($per_page==20)?'selected':'' ?>>20</option>
                        <option value="50" <?php echo ($per_page==50)?'selected':'' ?>>50</option>
                    </select>
                </form>
                
            </div>
        </div>
        <table class="table table-bordered table-hover table-highlight">
            <thead>
                <tr class="bg-info-100 font-weight-bold">
                    <th>Sr. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Print</th>
                    <th>Details</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cnt=1; 
                foreach($appointment_list as $list)  
                { 
                ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo isset($list['name'])?$list['name']:'' ?></td>
                        <td><?php echo isset($list['email'])?$list['email']:'' ?></td>
                        <td><?php echo isset($list['phone'])?$list['phone']:'' ?></td>
                        <td><?php echo isset($list['service'])?$list['service']:'' ?></td>
                        <td><?php echo isset($list['created_at'])?date('m-d-Y H:i:s',strtotime($list['created_at'])):'' ?></td>
                        <td><a href="javascript:void(0);" id="<?php echo isset($list['id'])?$list['id']:'' ?>" class="myprint"><i class="fa fa-print"></i></a></td>
                        <td><a href="admin-appointment-details.php?view=<?php echo isset($list['id'])?$list['id']:'' ?>"><i class="fa fa-info-circle"></i></a></td>
                        <td><a href="admin-appointments.php?delete=<?php echo isset($list['id'])?$list['id']:'' ?>"><i class="fa fa-trash-o"></i></i></a></td>
                    </tr>
                <?php
                $cnt++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
        if (isset($_GET['page'])) {
            $cnt = (($per_page * (int) $_GET['page']) - $per_page) + 1;
        } 
        else {
            $cnt = 1;
        }
        
        if ($item_count > $per_page)
        {
            ?>
                <ul class="pagination align-self-end m-3"><?php echo $PaginateIt->GetPageLinks(); ?> </ul>
            <?php
        }
    ?>
</div>
                    
                </div>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </div>

<script>
    $('.myprint').on('click', function () {
        var appointment_id = this.id;
        // console.log(appointment_id);
        $.ajax({
          type: 'POST',
          url: 'print_appointment.php',
          async: false,
          data: {'appointment_id': appointment_id},
          success: function (html) {
                    //  alert(html);
                     var divToPrint;
                     newWin = window.open("");
                     newWin.document.write(html);
                     newWin.print();
                     newWin.close();
                 }
             });
    });
</script>

</body>
</html>