<?php
include_once '../classes/startup.php';
$core = new Core;
$pr_about_us = new MV_AboutUs;


$about = $pr_about_us->index();
//  print_r($about  );

$page_name = 'About Us';
include("includes/top_header.php");
?>

<body>
    <?php include("includes/header.php"); ?>
    <div class="container-fluid main-container">
        <?php include("includes/sidebar.php"); ?>	
        <div class="col-md-10 content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="javascript:history.go(-1)" title="Back" class="btn btn-default" style="float: left; padding: 5px; margin-top: -5px; margin-right: 5px; background: #fff; border: none;"><img src="images/back.png"></a>
                     About Us
                    <a href="manage_about_edit.php" title="Edit" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none; font-weight: bold;">Edit About Us</a>
                </div>
                
                <div class="panel-body">
                    <table class="table table-dark">
                        <tbody>

                            <tr>
                                <td> <img width="50" src="<?php echo isset($about['photourl_1'])?'../'.$about['photourl_1']:'' ?>" /> </td>
                                <td> <img width="50" src="<?php echo isset($about['photourl_2'])?'../'.$about['photourl_2']:'' ?>" /> </td>
                                <td> <img width="50" src="<?php echo isset($about['photourl_3'])?'../'.$about['photourl_3']:'' ?>" /> </td>
                                
                                <!-- <td><?php echo html_entity_decode($about['title']) ?></td> -->
                                <td><?php echo html_entity_decode($about['description']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>
</div>
</body>
</html>