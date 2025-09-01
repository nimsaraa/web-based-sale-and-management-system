<?php

include_once '../commons/session.php';
include_once '../Model/user_model.php';


//get user info from session
$userrow = $_SESSION["user"];
$userObj = new User();

$roleResult= $userObj->getAllRoles();

$user_id= base64_decode($_GET["user_id"]);
$userResult=$userObj->getUser($user_id);
$contactResult=$userObj->getUserContact($user_id);

$contactrow=$contactResult->fetch_assoc();
$userRow=$userResult->fetch_assoc();


//get already assigned functions

$functionArray=array();
$userFunctionResult=$userObj->getUserFunctions($user_id);
while($fun_row=$userFunctionResult->fetch_assoc()){
    array_push($functionArray, $fun_row["function_id"]);
}

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
            $pageName = "EDIT USER"
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
                    
            
            <form action="../Controller/user_controller.php?status=update_user" method="post" enctype="multipart/form-data">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" id="msg">
                            
                        </div>
                        <?php
                        if(isset($_GET["msg"]))
                        {
                        ?>
                         <div class="col-md-6 col-md-offset-3 alert alert-danger" >
                            <?php  echo base64_decode($_GET["msg"]);    ?>
                        </div>
                        <?php 
                        }
                        ?>
                        
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                    

                    <div class="row"> 
                        <div class="col-md-2">
                            <label class="control-label">First Name</label>
                             </div>
                            <div class="col-md-4">
                                <input type="hidden" class="user_id"  name="user_id" value="<?php echo $user_id ?>" />
                            
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $userRow["user_fname"]; ?>"/>
                        </div>
                        
                        <div class="col-md-2">
                            <label class="control-label">Last Name</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $userRow["user_lname"]; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    
                    <div class="row"> 
                        <div class="col-md-2">
                            <label class="control-label">Date Of Birth</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" class="form-control" name="dob" id="dob" value="<?php echo $userRow["user_dob"]; ?>"/>
                        </div>
                        
                        <div class="col-md-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $userRow["user_email"]; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    
                    <div class="row"> 
                        <div class="col-md-2">
                            <label class="control-label">NIC No</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="nic" id="nic" value="<?php echo $userRow["user_nic"]; ?>"/>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Image</label>
                        </div>
                        <div class="col-md-4">
                            <input type="file" class="form-control" name="user_image" id="user_image" onchange="displayImage(this);"/>
                            <br>
                            <?php 
                                                    if ($userRow["user_image"]!=""){
                                                        $image=$userRow["user_image"];
                                                        ?>
                                                    
                                                    <img id="img_prev" style="" src="../images/user_images/<?php  echo $image; ?>" width="60px" height="60px"/>
                                                    <?php
                                                    }
                                                    ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    
                    <div class="row"> 
                        <div class="col-md-2">
                            <label class="control-label">contact no</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="cno" id="cno"
                                   <?php
                                   if($contactrow!=null){
                                       ?>
                                   value="<?php echo $contactrow["contact_number"]; ?>"
                                   <?php
                                   }
                                   ?>
                                   />
                        </div>
                        
                        <div class="col-md-2">
                            <label class="control-label">Address</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $userRow["address"]; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    
                    <div class="row"> 
                        <div class="col-md-2">
                            <label class="control-label">User role</label>
                        </div>

                        <div class="col-md-4">
                            <select name="user_role" id="user_role" class="form-control" required="required">
                                <option value="">---------</option>
                                <?php
                                    while ($roleRow=$roleResult->fetch_assoc())
                                    {
                                ?>
                                    <option value="<?php echo $roleRow["role_id"]; ?>"
                                        <?php 
                                        if($roleRow["role_id"]==$userRow["user_role"]){
                                            ?>
                                        selected
                                        <?php
                                        }
                                        ?>
                                        >
                                        <?php echo $roleRow["role_name"]; ?>
                                    </option>
                                    <?php
                                            }
                                    ?>

                            </select>
                        
                        </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                        
                        <div class="row">
                            <div id="display_functions">
                                
                                <?php
                                
                                $role_id=$userRow["user_role"];
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
                                            <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"]; ?>"

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
                    
                   
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-offset-3 col-md-6">
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                        <input type="reset" class="btn btn-danger" value="Reset"/>
                    </div>
                </div>
        </div>


        </form>
        </div>
        </body>
        <script src="../JS/jquery-3.7.1.js"></script>
        <script src="../JS/uservalidation.js"></script>
        
        <script>
            function displayImage(input){
            if(input.files && input.files[0])
            {
               var reader = new FileReader();
               reader.onload = function (e){
               $("#img_prev").attr('src',e.target.result).width(80).height(60);
               
               };
               reader.readAsDataURL(input.files[0]);
            }
        }
        </script>    
        </html>



