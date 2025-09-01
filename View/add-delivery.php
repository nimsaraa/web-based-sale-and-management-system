<?php

include_once '../commons/session.php';
include_once '../Model/order_model.php';
include_once '../Model/delivery_model.php';

$userrow = $_SESSION["user"];
$orderObj= new Order();
$delobj= new Delivery();
$orderResult=$orderObj->getAllorders();
$vehicleResult=$delobj->getAllVehicles();

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
            $pageName = "ASSIGN DELIVERY";
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
                    
                    <form action="../Controller/delivery_controller.php?status=add_delivery" method="post">
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
                                    <label class="control-label">Choose order</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="order" id="order" class="form-control" required="required">
                                        <option value="">---------</option>
                                        <?php
                                        $orderResult->data_seek(0);
                                        while ($orderRow = $orderResult->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $orderRow["order_id"]; ?>"
                                                    data-payment-id="<?php echo $orderRow["pay_type_id"];?>"
                                                    data-payment-name="<?php echo $orderRow["payment_type"];?>">
                                                    
                                            
                                            order Id: <?php echo $orderRow["order_id"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Payment </label>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="text" class="form-control" name="payment_type" id="payment_type" readonly />

                                    
                                    <input type="hidden" name="pay_type_id" id="pay_type_id_hidden" />

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Set vehicle</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="vehicle" id="vehicle" class="form-control" required="required">
                                        <option value="">---------</option>
                                        <?php
                                        
                                        while ($vehiclerow = $vehicleResult->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $vehiclerow["vehicle_id"]; ?>">
                                                    
                                             <?php echo $vehiclerow["vehicle_no"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
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
            </div>


    </div>
</body>
            <script>
                    document.getElementById('order').addEventListener('change', function () {
                    const selectedOption = this.options[this.selectedIndex];

        const paymentId = selectedOption.getAttribute('data-payment-id'); 
        const paymentName = selectedOption.getAttribute('data-payment-name'); 

      
       document.getElementById('payment_type').value = paymentName || '';
        document.getElementById('pay_type_id_hidden').value = paymentId || '';

        });
            </script>


</html>