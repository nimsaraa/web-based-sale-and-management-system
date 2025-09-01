<?php 

include '../commons/session.php';
include_once '../Model/supplier_model.php';

$userrow = $_SESSION["user"];
$supplierObj=new Supplier();


$activeResult=$supplierObj->getActivateSuppliercount();
$activate_row=$activeResult->fetch_assoc();
$countResult=$supplierObj->getSupplierCount();
$count_row=$countResult->fetch_assoc()

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
            $pageName = "SUPPLIER MANAGEMENT"
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
                <div class="">
                    
                     <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="supplier.php">
                            <span class="glyphicon glyphicon-home"></span> &nbsp;
                            Supplier Menu
                        </a>
                    </div>
                </div>
                
            </div>
                
                <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center" >
                        <a href="add-supplier.php">
                            <span class="glyphicon glyphicon-plus"></span> &nbsp;
                            Add Supplier
                        </a>
                    </div>
                </div>
                
            </div>
                <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="view-suppliers.php">
                            <span class="glyphicon glyphicon-search"></span> &nbsp;
                            View Suppliers
                        </a>
                    </div>
                </div>
                
            </div>

                <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="supplier-report.php">
                            <span class="glyphicon glyphicon-book"></span> &nbsp;
                            Generate Supplier reports
                        </a>
                    </div>
                </div>
            </div>
                    <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="supplier-invoice.php">
                            <span class="glyphicon glyphicon-list-alt"></span> &nbsp;
                            Add Supplier Invoices
                        </a>
                    </div>
                </div>
            </div>
                    
                    <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <p align="center">Total Suppliers</p>
                        </div>
                        
                        <div class="panel-body">
                            <h1 class="h1" align="center"><?php echo $count_row["supplier_count"]; ?></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px">
                        <div class="panel-heading">
                            <p align="center">Active Suppliers</p>
                        </div>
                        
                        <div class="panel-body">
                            <h1 class="h1" align="center"><?php echo $activate_row["supplier_count"]; ?></h1>
                        </div>
                    </div>
                </div>
                   
                   

               

            </div>
            </div>
            
        </div>
    </body>
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
   
    
</html>
    
    