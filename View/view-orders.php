<?php

include_once '../commons/session.php';
include_once '../Model/order_model.php';

$userrow = $_SESSION["user"];
$orderObj=new Order();
$orderResult=$orderObj->getAllorders();

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
            $pageName = "VIEW ORDERS";
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
                                <table  class="table table-hover" id="ordertable">
                                    <thead class="thead-dark">
                                        <tr>

                                            
                                            <th>Customer Name</th>
                                            <th>Order date</th>
                                            <th>Total price</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($orderrow = $orderResult->fetch_assoc()) {

                                            $order_id = $orderrow["order_id"];
                                            $order_id = base64_encode($order_id);
                                            ?>
                                            <tr>

                                                    <td>
                                                        <?php
                                                        echo $orderrow["cus_fname"]." ".$orderrow["cus_lname"];

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $orderrow["order_date"];
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo $orderrow["total"];
                                                        ?>
                                                    </td>
                                                    <td>

                                                        <a href="view-order.php?order_id=<?php echo $order_id; ?>" class="btn btn-info">
                                                                View
                                                                &nbsp;
                                                                <span class="glyphicon glyphicon-search">
                                                                </span>
                                                            </a>
                                                    <a href="edit-order.php?order_id=<?php echo $order_id; ?>" class="btn btn-warning">
                                                        Edit
                                                        &nbsp;
                                                        <span class="glyphicon glyphicon-pencil">
                                                        </span>
                                                    </a>
                                                    <a href="../controller/order_controller.php?status=delete&order_id=<?php echo $order_id; ?>" class="btn btn-danger">
                                                        Delete
                                                        &nbsp;
                                                        <span class="glyphicon glyphicon-trash">
                                                        </span>
                                                    </a>
                                                        <a href="generate-order-invoice.php?order_id=<?php echo $order_id; ?>" class="btn btn-success">
                                                                Generate invoice
                                                                &nbsp;
                                                                <span class="glyphicon glyphicon-book">
                                                                    </span>
                                                            </a>
                                                        <a href="order-payment.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">
                                                               Payment
                                                                &nbsp;
                                                                <span class="glyphicon glyphicon-usd">
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
                $("#ordertable").DataTable();
            });
    
    
            </script>
</html>