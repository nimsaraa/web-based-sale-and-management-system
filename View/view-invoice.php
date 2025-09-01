<?php 

include '../commons/session.php';
include_once '../Model/supplier_model.php';

$userrow = $_SESSION["user"];
$supplierObj=new Supplier();
$sup_id=$_GET["sup_id"];
$sup_id=base64_decode($_GET["sup_id"]);

$supplierInvoiceResult=$supplierObj->getSupplierInvoice($sup_id);




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
            $pageName = "VIEW SUPPLIER"
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
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            
                            <div class="row">
                                <h2>Supplier Invoices</h2>
                            </div>
                        </div>
                       

                             <div class="row">
                                 <?php while ($supplierInvoiceDetailrow = $supplierInvoiceResult->fetch_assoc()) { ?>
                                     <div class="col-md-4">

                                         <h5>Invoice No: <?php echo ($supplierInvoiceDetailrow["invoice_number"]); ?></h5>


                                         <img src="../images/invoices/<?php echo ($supplierInvoiceDetailrow["invoice"]); ?>" 

                                              style="height: 200px; width: 150px; " />
                                     </div>
                                 <?php } ?>
                             </div>
                         </div>
            </div>
            </div>
            
        </div>
    </body>
    
</html>
    
    


