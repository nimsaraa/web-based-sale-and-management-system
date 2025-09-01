<?php

include_once '../commons/session.php';

include_once '../Model/order_model.php';


$userrow = $_SESSION["user"];

$orderobj= new Order();




$order_id= base64_decode($_GET["order_id"]);
$orderResult=$orderobj->getorder($order_id);
$orderItemResult=$orderobj->getorderItems($order_id);
$orderrow=$orderResult->fetch_assoc();



        
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
            $pageName = "VIEW ORDER";
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
                   
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3" id="msg">
                            </div>
                            <?php
                            if (isset($_GET["msg"])) {
                                ?>
                                <div class="col-md-6 col-md-offset-3 alert alert-danger" >
                                    <?php echo base64_decode($_GET["msg"]); ?>
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
                                <label class="control-label">customer name</label>
                            </div>
                            <div class="col-md-4">
                               <input  class="form-control"  value="<?php  echo $orderrow["cus_fname"]." ".$orderrow["cus_lname"] ?>" readonly/>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">order date</label>
                            </div>
                            <div class="col-md-4">
                                <input  class="form-control"  value="<?php  echo $orderrow["order_date"] ?>" readonly/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Payement type</label>
                            </div>
                            <div class="col-md-4">
                               <input class="form-control" value="<?php echo $orderrow["payment_type"]; ?>" readonly/>

                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Total Amount (RS)</label>
                            </div>
                            <div class="col-md-4">
                                <input  class="form-control"  value="<?php echo $orderrow["total"] ?>" readonly=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="productItemsTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Product</th>
                                                <th>Size</th>
                                                <th>Colour</th>
                                                <th>Unit Price (RS)</th>
                                                <th>Quantity</th>
                                                <th>Total Price (RS)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($orderItemrow = $orderItemResult->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                    <td>
                                                      <input class="form-control"  value="<?php echo $orderItemrow['product_name']; ?>" readonly>

                                                    </td>
                                                    <td>

                                                         <input class="form-control"  value="<?php echo $orderItemrow['size']; ?>" readonly>
                                                </td>

                                                
                                                <td>
                                                   <input class="form-control"  value="<?php echo $orderItemrow['colour']; ?>" readonly>
                                                </td>

                                                <td>
                                                    <input class="form-control" value="<?php echo $orderItemrow['unit_price']; ?>" readonly >
                                                </td>

                                                <td>
                                                    <input class="form-control" value="<?php echo $orderItemrow['quantity']; ?>" readonly>
                                                </td>

                                                <td>
                                                    <input class="form-control"  value="<?php echo $orderItemrow['total_price']; ?>" readonly>
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
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>



                    </div>
                   
                   
                </div>
            </div>
            
            
        </div>
    </body>


    

</html>