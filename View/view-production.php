<?php

include_once '../commons/session.php';
include_once '../Model/production_model.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$productionObj= new Production();
$productObj= new Product();


$pro_id= base64_decode($_GET["pro_id"]);

$productionResult=$productionObj->getproduction($pro_id);
$productResult=$productObj->getAllSku();
$productionDetailsRow=$productionResult->fetch_assoc();
$productdetailrow=$productResult->fetch_assoc();


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
            $pageName = "VIEW PRODUCTION"
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
                                <a href="view-productions.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Productions
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-production.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add Production
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="production-reports.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    Reports
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        &nbsp;
                    </div>
                    
                    <div class="col-md-9">
                        <div class="row">
                            
                            <div class="row">
                                <h2>Production Details</h2>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                       
                        <div class="row">
                            <div class="col-md-6">
                                <h3>SKU Id</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productionDetailsRow["sku_id"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Product name</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productdetailrow["product_name"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Size</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productdetailrow["size"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Colour</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productdetailrow["colour"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Date</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productionDetailsRow["p_date"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Description</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productionDetailsRow["description"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Quantity</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $productionDetailsRow["p_qty"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                         
            </div>
                   
                    
                    
                    
                </div>
            </div>
            
            
        </div>
    </body>
</html>