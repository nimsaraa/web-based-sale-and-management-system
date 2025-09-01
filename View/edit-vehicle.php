<?php

include_once '../commons/session.php';
include_once '../Model/delivery_model.php';

$userrow = $_SESSION["user"];
$delobj= new Delivery();
$vehicle_id= base64_decode($_GET["vehicle_id"]);
$vehicleResult=$delobj->getVehicle($vehicle_id);

$vehiclerow=$vehicleResult->fetch_assoc();

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
            $pageName = "EDIT VEHICLE";
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
                                    View vehicle
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
                    <form action="../Controller/delivery_controller.php?status=edit_vehicle" method="post" >
                        
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
                                    <label class="control-label">Vehicle number</label>
                                </div>


                                <div class="col-md-4">
                                     <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
                                    <input type="text" class="form-control" name="vno" id="vno" value="<?php echo $vehiclerow["vehicle_no"] ?>"/>
                                   
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Vehicle type</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="vtype" id="vtype" value="<?php echo $vehiclerow["vehicle_type"] ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
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
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/vehiclevalidation.js"></script>
</html>