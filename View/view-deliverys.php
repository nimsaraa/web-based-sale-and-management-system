<?php

include_once '../commons/session.php';
include_once '../Model/delivery_model.php';

$userrow = $_SESSION["user"];
$delobj= new Delivery();
$delResult=$delobj->getAllDeliveries();

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
            $pageName = "VIEW DELIVERIES";
            ?>
            <?php
            include_once '../includes/header_row_includes.php';
            ?>
             <link rel="stylesheet"  type="text/css" href="../css/dataTables.bootstrap.min.css"/>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>
            <div style="height: 50px" align="center">
                <div class="col-md-12">
                   
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-deliverys.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View delivery
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-delivery.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Assign delivery
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-vehicle.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add vehicle
                                </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-vehicles.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View vehicles
                                </a>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="delivery-reports.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Reports
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
                                <table  class="table table-hover" id="deliverytable">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th>Order Id</th>
                                            <th>Payement type</th>
                                            <th>Vehicle number</th>
                                            <th>status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                            <tbody>
                                <?php
                                                  
                                  
                                while($delrow=$delResult->fetch_assoc()){
                                    
                                    $delivery_id=$delrow["delivery_id"];
                                    $delivery_id= base64_encode($delivery_id);
                                    
                                    $status="delivered";
                                    
                                    if($delrow["delivery_status"]==0){
                                        $status="pending";
                                    }
                                              
                                   ?>  
                                  
                                
                                <tr>
                                    <td>
                                        <?php
                                        
                                                    
                                                 echo  $delrow["order_id"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo  $delrow["payment_type"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo  $delrow["vehicle_no"];
                                        ?>
                                    </td>
                                    <td
                                        <?php
                                            if($delrow["delivery_status"]==1){
                                        ?>
                                        
                                            class="success"
                                        <?php
                                        }else if($delrow["delivery_status"]==0){
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
                                         if ($delrow["delivery_status"]==0){
                                         ?>  
                                     
                                        <a href="../controller/delivery_controller.php?status=delivered&delivery_id=<?php echo $delivery_id; ?>" class="btn btn-success">
                                            Delivered
                                            &nbsp;
                                            <span class="glyphicon glyphicon-ok">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        
                                        
                                        
                                        
                                        <a href="edit-delivery.php?delivery_id=<?php echo $delivery_id;?>" class="btn btn-warning">
                                                Edit
                                                &nbsp;
                                                <span class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a>
                                        <a href="../controller/delivery_controller.php?status=delete_delivery&delivery_id=<?php echo $delivery_id; ?>" class="btn btn-danger">
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
        $("#deliverytable").DataTable();
    });
    
    
    </script>
</html>