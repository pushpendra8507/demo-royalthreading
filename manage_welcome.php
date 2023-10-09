<?php
include_once '../classes/startup.php';
$core = new Core;
$welcome = new MV_Welcome;

$welcome_data = $welcome->index();

$page_name = 'Welcome';

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
                    Welcome
                    <a href="manage_welcome_edit.php" title="Edit" class="btn btn-default" style="float: right; padding: 5px; margin-top: -5px; background: #fff; border: none; font-weight: bold;">Update Welcome Text</a>
                </div>

                <div class="panel-body">
                    <table class="table table-dark">
                        <tbody>

                            <tr>
                                <td> <img width="50" src="<?php echo isset($welcome_data['photourl_1']) ? '../' . $welcome_data['photourl_1'] : '' ?>" /> </td>
                                <td><img width="50" src="<?php echo isset($welcome_data['photourl_2']) ? '../' . $welcome_data['photourl_2'] : '' ?>" /></td>
                            </tr>
                            <tr>
                                <td>Description 1</td>
                                <td><?php echo isset($welcome_data['description_1']) ? $welcome_data['description_1'] : '' ?></td>
                            </tr>
                            <!-- <tr>
                                <td>Description 2</td>
                                <td ><?php echo isset($welcome_data['description_2']) ? $welcome_data['description_2'] : '' ?></td>
                            </tr> -->
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