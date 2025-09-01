<?php

include_once '../commons/session.php';
include_once '../Model/inventory_model.php';
include_once '../Model/supplier_model.php';

$userrow = $_SESSION["user"];
$supplierObj= new Supplier();
$supResult=$supplierObj->getAllSuppliers();
$rawobj= new Stock();
$raw_id= base64_decode($_GET["raw_id"]);
$rawResult=$rawobj->getraw($raw_id);
$rawRow=$rawResult->fetch_assoc();




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
            $pageName = "EDIT RAW MATERIAL"
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
                <div>
                     <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-products-stock.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View product Stock
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center" >
                                <a href="view-raw-stock.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    view raw material stock
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="inventory-reports.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Generate stock reports
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <form action="../Controller/inventory_controller.php?status=edit_raw" method="post">
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
                                    <label class="control-label">Raw Material Name</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="hidden" class="raw_id"  name="raw_id" value="<?php echo $raw_id ?>" />
                                    <input type="text" class="form-control" name="rname" id="rname" value="<?php  echo $rawRow["raw_name"] ?>" />
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Supplier name</label>
                                </div>


                                <div class="col-md-4">
                                    <select name="supplier_name" id="supplier_name" class="form-control"  required="required">
                                <option value="">---------</option>
                                <?php
                                    while ($supRow=$supResult->fetch_assoc())
                                    {
                                ?>
                                    <option value="<?php echo $supRow["sup_id"]; ?>"
                                            
                                            <?php
                                            if($supRow["sup_id"]==$rawRow["sup_id"]){
                                                ?>
                                            selected
                                            <?php
                                            }
                                            ?>
                                            
                                            
                                            >
                                        <?php echo $supRow["Supplier_name"]; ?>
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
    
    
</html>

