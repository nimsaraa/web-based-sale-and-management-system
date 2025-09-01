<?php

include_once '../commons/session.php';
include_once '../Model/order_model.php';

$userrow = $_SESSION["user"];
$orderObj= new Order();
$order_id= base64_decode($_GET["order_id"]);
$orderResult=$orderObj->getorder($order_id);
$orderrow=$orderResult->fetch_assoc();


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
            $pageName = "ORDER PAYEMENT";
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
                   
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-orders.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-order.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add order
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="order-reports.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
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
                                <table  class="table table-hover" id="paytable">
                                    <thead class="thead-dark">
                                        <tr>

                                            
                                            <th>payment type</th>
                                            <th>Total price</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $status="payed";
                                    
                                    if($orderrow["pay_status"]==0){
                                        $status="pending";
                                    }
                                    ?>
                                            <tr>

                                                    <td>
                                                        <?php
                                                        echo $orderrow["payment_type"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                       echo $orderrow["total"];
                                                        ?>
                                                    </td>
                                                    <td>

                                                        <?php
                                                        echo $orderrow["order_date"];
                                                        ?>

                                                    </td>
                                                    <td
                                                    <?php
                                                    if ($orderrow["pay_status"] == 1) {
                                                        ?>

                                                            class="success"
                                                            <?php
                                                        } else if ($orderrow["pay_status"] == 0) {
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
                                                        if ($orderrow["pay_status"] == 0) {
                                                            ?>  

                                                            <a href="../controller/order_controller.php?status=payed&order_id=<?php echo base64_encode($order_id); ?>" class="btn btn-success">
                                                                Payed
                                                                &nbsp;
                                                                <span class="glyphicon glyphicon-ok">
                                                                </span>

                                                            </a> 
                                                            <?php
                                                        }
                                                        ?>
                                                       
                                                    </td>
                                                </tr>
                                              
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
                $("#paytable").DataTable();
            });
    
    
            </script>
</html>