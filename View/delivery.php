<?php

include_once '../commons/session.php';

$userrow = $_SESSION["user"];

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
            $pageName = "DELIVERY MANAGEMENT";
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
                   
                   
                    
                    
                    
                </div>
            </div>
            
            
        </div>
    </body>
</html>