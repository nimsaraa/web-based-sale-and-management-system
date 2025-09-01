<?php

include_once '../commons/session.php';
include_once '../Model/inventory_model.php';
include_once '../Model/product_model.php';
include_once '../Model/production_model.php';

$userrow = $_SESSION["user"];
$productObj=new Product();
$stockobj=new Stock();
$productionObj= new Production();

$skuResult=$productObj->getAllSku();
$stockResult=$stockobj->getAllStock();
$quantityResult=$stockobj->getQuntitySum();
$productionResult=$productionObj->getCompletedProductions();
    
       

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
            $pageName = "VIEW PRODUCTS STOCK"
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
                                <a href="reorder level-products.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    reorder level products
                                </a>
                            </div>
                        </div>
                    </div>
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
                                   reports
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
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
                                <table class="table table-hover" id="productstocktable">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th>SKU No</th>
                                            <th>Product_name</th>
                                            <th>Size</th>
                                            <th>Colour</th>
                                            <th>Available QTY</th>
                                            <th>reorder-level</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                            <tbody>
                                <?php
                                
                                $stockData = [];
                                while ($stockrow = $stockResult->fetch_assoc()) {
                                    $stockData[$stockrow['sku_id']] = $stockrow;
                                }

                                $quantityData = [];
                                while ($quantityrow = $quantityResult->fetch_assoc()) {
                                    $quantityData[$quantityrow['sku_id']] = $quantityrow['total_quantity'];
                                }
                                $productionRows = [];
                                while ($row = $productionResult->fetch_assoc()) {
                                    $productionRows[] = $row;
                                }




                                while ($skuRow = $skuResult->fetch_assoc()) {
                                    $sku_id = base64_encode($skuRow["sku_id"]);
                                    $sku_id = $skuRow["sku_id"];


                                    if (isset($quantityData[$sku_id])) {
                                        $quantity = $quantityData[$sku_id];
                                    } else {
                                        $quantity = 0;
                                         }
                                           
                                           if (isset($stockData[$sku_id])) {
                                                    $stockRow = $stockData[$sku_id];
                                         } else {
                                                    $stockRow = ['quantity' => 0, 'reorder_level' => 0];
                                          }


                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $skuRow["sku_id"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $skuRow["product_name"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $skuRow["size"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $skuRow["colour"]; ?>
                                        </td>
                                            <td>
                                                <?php echo $quantity; ?>
                                            </td>
                                            <td>
                                                <?php echo $stockRow["reorder_level"]; ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#modal_<?php echo $sku_id; ?>" class="btn btn-success">
                                                    ADD STOCK 
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                                <a href="../controller/inventory_controller.php?status=clear&sku_id=<?php echo base64_encode($sku_id); ?>" class="btn btn-danger">
                                                    CLEAR
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>

                                            </td>

                                        </tr>

                                        <!-- Modal for add stock for SKU -->
                                <div class="modal fade" id="modal_<?php echo $sku_id; ?>"  role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="../Controller/inventory_controller.php?status=add_product_stock">
                                                
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        Add Stock for SKU: <?php echo $sku_id; ?>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="sku_id" value="<?php echo $sku_id; ?>">

                                                    <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="number" class="form-control" name="qty"  required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Production Id</label>
                                                            <select name="pro_id" id="pro_id" class="form-control" required>
                                                                <option value="">---------</option>
                                                                <?php foreach ($productionRows as $productionRow) { ?>
                                                                    <option value="<?php echo $productionRow["pro_id"]; ?>">
                                                                        Pro Id : <?php echo  $productionRow["pro_id"]; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                        </div>

                                                        <div class="form-group">
                                                            <label>Change reorder Level</label>
                                                            <input type="number" class="form-control" name="relevel" value="<?php echo $stockRow["reorder_level"]; ?>" $sku_id; required>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    
    
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
        $("#productstocktable").DataTable();
    });
    
    
    </script>
   

</html>

