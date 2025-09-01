<?php

include_once '../commons/session.php';


include_once '../Model/purchase_model.php';

$userrow = $_SESSION["user"];

$purchaseObj=new Purchase();



$po_id= base64_decode($_GET["po_id"]);
$purchaseresult=$purchaseObj->getpo($po_id);
$poItemresult=$purchaseObj->getpoItems($po_id);
$purchaserow=$purchaseresult->fetch_assoc();




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
            $pageName = "VIEW PURCHASE ORDER";
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
                                <a href="view-po.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View purchase orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-po.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add PO
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-grns.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-grn.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="grn-report.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Purchase Reports
                                </a>
                            </div>
                        </div>
                    </div>
              
                </div>
                
                   <div class="row">
                        &nbsp;
                    </div>
                     <div class="row">
                        &nbsp;
                    </div>
                    

                    <div class="col-md-12">
                     
                        <div class="row"> 
                            <div class="col-md-2">
                                <label class="control-label">Supplier name</label>
                            </div>
                            <div class="col-md-4">
                                <input  class="form-control"  value="<?php  echo $purchaserow["Supplier_name"] ?>" readonly/>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">User Name</label>
                            </div>
                            <div class="col-md-4">
                                
                                <input " class="form-control"  value="<?php echo $userrow["user_fname"] . " " . $userrow["user_lname"]; ?>" readonly=""/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Purchase order date</label>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control"  value="<?php  echo $purchaserow["po_date"] ?>" readonly=""/>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Po Total Amount (RS)</label>
                            </div>
                            <div class="col-md-4">
                                <input  class="form-control" value="<?php  echo number_format($purchaserow["po_total"],2)?>" readonly="" />
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" >
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Raw Name</th>
                                                <th>Unit Price (RS)</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Total Price (RS)</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            while ($poItemrow = $poItemresult->fetch_assoc()) {
                                                
                                             
                                            ?>
                                            <tr>
                                                <td>
                                                    <input  class="form-control"  value="<?php  echo $poItemrow["raw_name"] ?>" readonly/>
                                                    
                                                     
                                                </td>
                                                <td>
                                                    <input  class="form-control"  value="<?php echo number_format($poItemrow['unit_price'],2); ?>" readonly>
                                                </td>

                                                <td>
                                                    <input  class="form-control"  value="<?php echo $poItemrow['qty']; ?>" readonly>
                                                </td>
                                                <td>
                                                     <input  class="form-control"  value="<?php echo $poItemrow['unit_name']; ?>" readonly>
                                                </td>
                                                <td>
                                                    <input  class="form-control"  value="<?php echo number_format($poItemrow['total_price'],2); ?>"readonly>
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
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

            </div>


            </div>

            </form>
            </div>
        </div>
    </body>
    
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/purchasevalidation.js"></script>


</html>