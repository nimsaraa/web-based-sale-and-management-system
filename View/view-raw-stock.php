<?php

include_once '../commons/session.php';
include_once '../Model/inventory_model.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$productObj=new Product();

$rawobj=new Stock();
$rawResult=$rawobj->getAllRaw();
$stockResult=$rawobj->getAllRawStock();
$quantityResult=$rawobj->getRawQuntitySum();
$unitResult = $rawobj->getAllUnits();    
$unitList = [];

while ($unitRow = $unitResult->fetch_assoc()) {
    $unitList[] = $unitRow;
}
    

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
            $pageName = "VIEW RAW MATERIAL STOCK"
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
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a href="view-raw.php" class="btn btn-primary">
                            VIEW RAW MATERIAL
                            &nbsp;
                            <span class="glyphicon glyphicon-search">
                            </span>
                        </a>
                    </div>
                    <div class="row">
                        &nbsp;
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
                        
                        <div class="raw">
                            <div class="col-md-12">
                                <table class="table table-hover" id="rawstocktable">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th>RAW NO</th>
                                            <th>Raw_material_name</th>
                                            <th>Available QTY</th>
                                            <th>reorder-level</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                         $RawstockData = [];
                                    while ($Rawstockrow = $stockResult->fetch_assoc()) {
                                        $RawstockData[$Rawstockrow['raw_id']] = $Rawstockrow;

                                    }
                                    
                                $quantityData = [];
                                    while ($quantityrow = $quantityResult->fetch_assoc()) {
                                             $quantityData[$quantityrow['raw_id']] = $quantityrow['total_quantity'];
                                     }

                                        
                                        while ($rawRow = $rawResult->fetch_assoc()) {
                                            $raw_id = base64_encode($rawRow["raw_id"]);
                                            $raw_id = $rawRow["raw_id"];
                                            
                                            
                                             if (isset($quantityData[$raw_id])) {
                                             $quantity = $quantityData[$raw_id];
                                             
                                         } else {
                                            $quantity = 0;
                                         }
                                           
                                           if (isset($RawstockData[$raw_id])) {
                                                    $RawstockRow = $RawstockData[$raw_id];

                                         } else {
                                                    $RawstockRow = ['quantity' => 0, 'reorder_level' => 0];
                                          }
                                            
                                            
                                            ?>
                                         <tr>
                                        <td>
                                            <?php echo $rawRow["raw_id"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $rawRow["raw_name"]; ?>
                                        </td>
                                        <td>

                                                <?php echo $quantity . ' ' . ($RawstockRow["unit_name"] ?? ''); ?>


                                            </td>
                                        <td>
                                           <?php echo $RawstockRow["reorder_level"] . (!empty($RawstockRow["unit_name"]) ? ' ' . $RawstockRow["unit_name"] : ''); ?>

                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#smodal_<?php echo $raw_id; ?>" class="btn btn-success">
                                                ADD  RAW STOCK 
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </a>
                                            <a href="../controller/inventory_controller.php?status=clear_raw&raw_id=<?php echo base64_encode($raw_id); ?>" class="btn btn-danger">
                                                    CLEAR
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </a>

                                        </td>
                                        
                                    </tr>
                                        <!-- Modal for add stock for SKU -->
                                <div class="modal fade" id="smodal_<?php echo $raw_id; ?>"  role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="post" action="../Controller/inventory_controller.php?status=add_raw_stock">
                                                
                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        Add Stock for RAW: <?php echo $raw_id; ?>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="raw_id" value="<?php echo $raw_id; ?>">

                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <input type="number" class="form-control" name="qty" >
                                                    </div>
                                                    <div class="form-group">
                                                            <label>Unit</label>
                                                            <select name="unit" id="unit" class="form-control" required="required">
                                                                <option value="">---------</option>

                                                                <?php foreach ($unitList as $unitRow) {
                                                                    ?>
                                                                    <option value="<?php echo $unitRow["unit_id"];
                                                                    ?>
                                                                            ">
                                                                                <?php echo $unitRow["unit_name"]; ?>
                                                                    </option>
                                                                    <?php
                                                                }
                                                                ?>

                                                                <option value="<?php echo $unitRow["unit_id"]; ?>">
                                                                    <?php echo $unitRow["unit_name"]; ?>
                                                                </option>
                                                            </select>
                                                        </div>

                                                    <div class="form-group">
                                                        <label>Change reorder Level</label>
                                                        <input type="number" class="form-control" name="relevel" value="<?php echo  $RawstockRow["reorder_level"]; ?>" $sku_id; >
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
     <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
        $("#rawstocktable").DataTable();
    });
    
    
    </script>
    
</html>

