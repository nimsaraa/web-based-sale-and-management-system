<?php

include_once '../commons/session.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$productObj=new Product();
$productResult=$productObj->getAllSku();

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
            $pageName = "ADD PRODUCTION"
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
                    
                    <form action="../Controller/production_controller.php?status=add_production" method="post">
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
                                    <label class="control-label">Select SKU</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="sku_id" id="sku_id" class="form-control"  required="required">
                                        <option value="">---------</option>
                                        <?php
                                        while ($productrow = $productResult->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $productrow["sku_id"]; ?>">
                                              SKU ID:  <?php echo $productrow["sku_id"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="control-label">Description</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text"class="form-control" name="pdescription" id="pdescription" >
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            
                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Production Date</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" name="pdate" id="pdate" required="required" min="<?php echo date("Y-m-d") ?>"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Quantity</label>
                                </div>
                                <div class="col-md-4">
                                    
                                    <input type="number" class="form-control" name="pqty" id="pqty" required="required"/>
                              
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
     <script src="../JS/productionvalidation.js"></script>
</html>