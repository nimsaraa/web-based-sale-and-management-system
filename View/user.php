<?php 

include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/user_model.php';

$userrow = $_SESSION["user"];

$moduleObj= new Module();
$moduleResult=$moduleObj->getAllModules();

$userObj= new User();
$activeResult=$userObj->getActivateUserCount();
$activate_row=$activeResult->fetch_assoc();
$deactiveResult=$userObj->getDeActivateUserCount();
$deactivate_row=$deactiveResult->fetch_assoc();

?>


<html>
    
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
    </head>
    
    <body>

        <div class="container">
            <?php
            $pageName = "USER MANAGEMENT"
            ?>
            <?php
            include_once '../includes/header_row_includes.php';
            ?>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>
            <div style="height: 50px" align="center">
                <div class="col-md-12"  >
                    
                     <div class="col-md-3">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="user.php">
                            <span class="glyphicon glyphicon-home"></span> &nbsp;
                            User Menu
                        </a>
                    </div>
                </div>
                
            </div>
                
                <div class="col-md-3">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center" >
                        <a href="add-user.php">
                            <span class="glyphicon glyphicon-plus"></span> &nbsp;
                            Add user
                        </a>
                    </div>
                </div>
                
            </div>
                <div class="col-md-3">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="view-users.php">
                            <span class="glyphicon glyphicon-search"></span> &nbsp;
                            View users
                        </a>
                    </div>
                </div>
                
            </div>

                <div class="col-md-3">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="user-report.php">
                            <span class="glyphicon glyphicon-book"></span> &nbsp;
                            Generate user reports
                        </a>
                    </div>
                </div>
                
            </div>
                   

               

            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel">
                <div class="panel-heading" style="height: 30px;background-color: #faf5f7">
                    <p align="center">
                    USER-ACTIVATION DETAILS
                    </p>
                </div>
                    </div>
                
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <p align="center">No of Active Users</p>
                        </div>
                        
                        <div class="panel-body">
                            <h1 class="h1" align="center"><?php echo $activate_row["user_count"]; ?></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px">
                        <div class="panel-heading">
                            <p align="center">No of De-Active Users</p>
                        </div>
                        
                        <div class="panel-body">
                            <h1 class="h1" align="center"><?php echo $deactivate_row["user_count"]; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
            
     
            
            

    </body>
     <script src="../js/jquery-3.7.1.js"></script>
 

</html>            