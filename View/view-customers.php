<?php 

include '../commons/session.php';
include_once '../Model/customer_model.php';

$userrow = $_SESSION["user"];
$customerObj = new Customer();
$customerResult =$customerObj->getAllCustomers();

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
            $pageName = "VIEW CUSTOMERS"
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
                <div class="col-md-12">

                    <div class="col-md-3">

                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="customer.php">
                                    <span class="glyphicon glyphicon-home"></span> &nbsp;
                                    Customer Menu
                                </a>
                            </div>
                        </div>

                    </div>
                
                    <div class="col-md-3">

                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center" >
                                <a href="add-customer.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add Customer
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-customers.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Customers
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="customer-report.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Generate Customer reports
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET["msg"])) {
                            $msg = base64_decode($_GET["msg"]);
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
                                <table  class="table table-hover" id="customertable">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                            <tbody>
                                <?php
                                                  
                                  
                                while($customerrow=$customerResult->fetch_assoc()){
                                    
                                    $cus_id=$customerrow["cus_id"];
                                    $cus_id= base64_encode($cus_id);
                                    
                                    $status="Active";
                                    
                                    if($customerrow["customer_status"]==0){
                                        $status="Deactive";
                                    }
                                              
                                   ?>            
                                      
                                  
                                
                                <tr>
                                    <td>
                                        <?php
                                        
                                                    
                                                 echo  $customerrow["cus_fname"]." ".$customerrow["cus_lname"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo $customerrow["cus_email"];
                                        ?>
                                    </td>
                                    <td
                                        <?php
                                            if($customerrow["customer_status"]==1){
                                        ?>
                                        
                                            class="success"
                                        <?php
                                        }else if($customerrow["customer_status"]==0){
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
                                        
                                         <?php
                                         if ($customerrow["customer_status"]==0){
                                         ?>  
                                     
                                        <a href="../controller/customer_controller.php?status=activate&cus_id=<?php echo $cus_id; ?>" class="btn btn-success">
                                            Activate
                                            &nbsp;
                                            <span class="glyphicon glyphicon-ok">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        <?php
                                         if ($customerrow["customer_status"]==1){
                                         ?>  
                                     
                                        <a href="../controller/customer_controller.php?status=deactivate&cus_id=<?php echo $cus_id; ?>" class="btn btn-danger">
                                            DeActivate
                                            &nbsp;
                                            <span class="glyphicon glyphicon-remove">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        
                                        <a href="view-customer.php?cus_id=<?php echo $cus_id; ?>" class="btn btn-info">
                                                View
                                                &nbsp;
                                                <span class="glyphicon glyphicon-search">
                                                </span>
                                            </a>
                                        <a href="edit-customer.php?cus_id=<?php echo $cus_id;?>" class="btn btn-warning">
                                                Edit
                                                &nbsp;
                                                <span class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a>
                                        <a href="../controller/customer_controller.php?status=delete&cus_id=<?php echo $cus_id; ?>" class="btn btn-danger">
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
            
        </div>
    </body>
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
        $("#customertable").DataTable();
    });
    
    
    </script>
</html>