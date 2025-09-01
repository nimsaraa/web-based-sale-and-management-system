<?php

include_once '../commons/session.php';
include_once '../Model/inventory_model.php';

$userrow = $_SESSION["user"];
$rawobj= new Stock();
$rawresult= $rawobj->getAllRaw();



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
            $pageName = "VIEW RAW MATERIAL";
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
                        <div>
                            <a href="add-raw.php" class="btn btn-success">
                                ADD RAW MATERIAL
                                &nbsp;
                                <span class="glyphicon glyphicon-plus">
                                </span>
                            </a>

                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        
                        <div class="raw">
                            <div class="col-md-12">
                                <table class="table table-hover" id="rawtable">
                                    <thead class="thead-dark">
                                        <tr>
                                    <th>Raw Name</th>
                                    <th>supplier_name</th>
                                    <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($rawRow= $rawresult->fetch_assoc()) {
                                            
                                            
                                            
                                            
                                             $raw_id = $rawRow["raw_id"];
                                            $raw_id = base64_encode($rawRow["raw_id"]);
                                           
                                            
                                            
                                  

                                            ?>
                                        
                                        <tr>
                                            <td>
                                                <?php  echo $rawRow["raw_name"] ?>
                                            </td>
                                            <td>
                                                <?php  echo $rawRow["Supplier_name"] ?>
                                            </td>
                                            <td>
                                                <a href="edit-raw.php?raw_id=<?php echo $raw_id;?>" class="btn btn-warning">
                                                Edit
                                                &nbsp;
                                                <span class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a>
                                                <a href="../controller/inventory_controller.php?status=delete&raw_id=<?php echo $raw_id; ?>" class="btn btn-danger">
                                                Delete
                                                &nbsp;
                                                <span class="glyphicon glyphicon-trash">
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
        $("#rawtable").DataTable();
    });
    
    
    </script>
</html>

