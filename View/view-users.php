<?php

include_once '../commons/session.php';
include_once '../model/module_model.php';
include_once '../model/user_model.php';


//get user information from session
$userrow=$_SESSION["user"];

$moduleObj = new Module();

$userObj = new User();

$moduleResult = $moduleObj->getAllModules();

$userResult = $userObj->getAllUsers();
?>

<html>
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
        <link rel="stylesheet"  type="text/css" href="../css/dataTables.bootstrap.min.css"/>

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
                &nbsp;
            </div>
            <div class="col-md-12">
                <?php
                            if (isset($_GET["msg"])) {
                                $msg= base64_decode($_GET["msg"]);
                                ?>
                
                <div class="row">
                    <div class="alert alert-success">
                        <center>
                        <span class="glyphicon glyphicon-saved">
                            &nbsp;
                            <?php
                                echo $msg;
                            ?>
                        </span>
                          </center>
                    </div>
                </div>
                   
                <?php
                            }
                ?>
            
 
            <div class="row">
                &nbsp;
            </div>
       
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover" id="usertable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                
                                while ($userrow=$userResult->fetch_assoc()){
                                    $user_id=$userrow["user_id"];
                                    $user_id= base64_encode($user_id);
                                    
                                    $img_path="../images/user_images/";
                                    if($userrow["user_image"]==""){
                                        $img_path= $img_path."user.png";
                                    }
                                    else{
                                        $img_path=$img_path.$userrow["user_image"];
                                    }
                                    
                                    $status="Active";
                                    
                                    if($userrow["user_status"]==0){
                                        $status="Deactive";
                                    }
                                              
                                   ?>            
                                                
                                            
                                <tr>
                                    <td>
                                        <img src="<?php  echo $img_path?>" widtch="50px" height="60px"/>
                                    </td>
                                    <td>
                                        <?php
                                        
                                                    
                                                 echo  $userrow["user_fname"]." ".$userrow["user_lname"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        
                                        echo  $userrow["user_email"];
                                        ?>
                                    </td>
                                    <td
                                        <?php
                                            if($userrow["user_status"]==1){
                                        ?>
                                        
                                            class="success"
                                        <?php
                                        }else if($userrow["user_status"]==0){
                                            ?>
                                        class="danger"
                                        <?php
                                            }
                                        ?>
                                        >
                                        <?php
                                            echo $status;
                                        
                                        ?>
                                    </td>
                                    <td>
                                        
                                        <a href="view-user.php?user_id=<?php echo $user_id;?>" class="btn btn-info">
                                            View
                                            &nbsp;
                                            <span class="glyphicon glyphicon-search">
                                            </span>
                                           
                                            
                                        </a> 
                                        
                                        
                                        <a href="edit-user.php?user_id=<?php echo $user_id;?>" class="btn btn-warning">
                                            Edit
                                            &nbsp;
                                            <span class="glyphicon glyphicon-pencil">
                                            </span>
                                            
                                        </a> 
                                      
                                         <?php
                                         if ($userrow["user_status"]==0){
                                         ?>  
                                     
                                        <a href="../controller/user_controller.php?status=activate&user_id=<?php echo $user_id; ?>" class="btn btn-success">
                                            Activate
                                            &nbsp;
                                            <span class="glyphicon glyphicon-ok">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        <?php
                                         if ($userrow["user_status"]==1){
                                         ?>  
                                     
                                        <a href="../controller/user_controller.php?status=deactivate&user_id=<?php echo $user_id; ?>" class="btn btn-danger">
                                            DeActivate
                                            &nbsp;
                                            <span class="glyphicon glyphicon-remove">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        
                                        
                                        <a href="../controller/user_controller.php?status=delete&user_id=<?php echo $user_id; ?>" class="btn btn-danger">
                                            Delete
                                            &nbsp;
                                            <span class="glyphicon glyphicon-trash">
                                            </span>
                                            
                                        </a> 
                                        
                                    </td>
                                </tr>
                                  <?php
                                   }
                                                ?>
                            </tbody>
                            
                        </table>
                        
                    </div>
                    </div>
                </div>
                
            </div>
            
            
        </div>
        
    </body>
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  
    <script>
        $(document).ready(function (){
        $("#usertable").DataTable();
    });
    
    
    </script>
    
</html>
