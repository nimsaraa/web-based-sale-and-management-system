<?php

include_once '../commons/session.php';
include_once '../Model/module_model.php';
include_once '../Model/user_model.php';


if(!isset($_GET["user_id"])){
    ?>

<script>
    window.location="login.php";
</script>

<?php
}
$userObj= new User();
$user_id=$_GET["user_id"];
$user_id= base64_decode($_GET["user_id"]);
$userResult=$userObj->getUser($user_id);
$userdetailrow=$userResult->fetch_assoc();

$usercontactResult=$userObj->getUserContact($user_id);
$contactrow=$usercontactResult->fetch_assoc();


//get user information from session
$userrow=$_SESSION["user"];

$moduleObj = new Module();

$userObj = new User();

$moduleResult = $moduleObj->getAllModules();

$functionArray =array();
$userfunctionResult= $userObj->getUserFunctions($user_id);
while($fun_row=$userfunctionResult ->fetch_assoc())
{
    array_push($functionArray, $fun_row["function_id"]);
    
}

$userResult = $userObj->getAllUsers();




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
            $pageName = "VIEW USER"
            ?>
            <?php
            include_once '../includes/header_row_includes.php';
            ?>
            <hr/>
            
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
            
            <div class="">
                <div class="row">
                    <div class="col-md-6">
                    
                    </div>
                    <div class="col-md-6">
                    <h2><?php echo  $userdetailrow["user_fname"]." ".$userdetailrow["user_lname"]?></h2>
                    </div>
                </div>
                <div class="col-md-5" style="height:350px">
                    <?php
                    $img=$userdetailrow["user_image"];
                    if($img==""){
                        $img="user.png";
                        
                    }
                    ?>
                    <img src="../images/user_images/<?php  echo $img; ?>" width="350px" height="400px">
                    
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>First name</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $userdetailrow["user_fname"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Last Name</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $userdetailrow["user_lname"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Date Of Birth</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $userdetailrow["user_dob"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>NIC</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $userdetailrow["user_nic"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Address</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $userdetailrow["address"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Contact Number</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $contactrow["contact_number"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Role</h3>
                        </div>
                        <div class="col-md-6">
                            <h3><?php echo $userdetailrow["role_name"]; ?></h3>
                        </div>
                    </div>
            
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="">
                <div class="row">
                            <div id="display_functions">
                                
                                <?php
                                
                                $role_id=$userdetailrow["user_role"];
                                $moduleResult=$userObj->getRoleModules($role_id);
                                
                                while ($module_row=$moduleResult->fetch_assoc()){
                                    $module_id=$module_row["module_id"];
                                    $functionResult=$userObj->getModuleFunctions($module_id);
                                    ?>
                                <div class="col-md-4">
                                        <h4>
                                            <?php
                                            echo $module_row["module_name"];
                                            echo "</br>";
                                            ?>
                                        </h4>
                                        <?php
                                        while ($fun_row = $functionResult->fetch_assoc()) {
                                            ?>
                                    <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"]; ?>" onclick="return false;" readonly="readonly"

                                                   <?php
                                                   if (in_array($fun_row["function_id"], $functionArray)) {
                                                       ?>

                                                       checked

                                                       <?php
                                                   }
                                                   ?>


                                                   />
                                                   <?php echo $fun_row["function_name"]; ?>
                                            <br/>
                                            <?php
                                        }
                                        ?>
                                </div>
                               <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                </div>
                
                
            </div>
            
            
            
          
        </div>
        </body>
        <script src="../JS/jquery-3.7.1.js"></script>
        
        </html>

