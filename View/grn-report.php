<?php

include_once '../commons/session.php';
include_once '../Model/purchase_model.php';

$userrow = $_SESSION["user"];
$purchaseObj= new Purchase();
$poResult = $purchaseObj->getTotalPOCount();
$grnResult = $purchaseObj->getTotalGRNCount();

$poRow = $poResult->fetch_assoc();
$grnRow = $grnResult->fetch_assoc();

?>

<html>
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        
        ?>
        <script src="../JS/plotly-3.0.1.min.js" charset="utf-8"> </script>
    </head>
    <body>
        <div class="container">
            <?php
            $pageName = "PURCHASE REPORTS";
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
                    <div class="row">

                        <center>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h3>PO vs GRN Summary Report</h3>
                                    <div class="text-center" id="chart" style="width:600px; height:300px;"></div>
                                </div>
                            </div>
                        </center>


                    
                    
                    
                </div>
            </div>
            
            
        </div>
    </body>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        var po = <?php echo $poRow["po_count"]; ?>;
        var grn = <?php echo $grnRow["grn_count"]; ?>;

        var data = [{
            values: [po, grn],
            labels: ['Total Purchase Orders', 'Total GRNs Received'],
            type: 'pie'
        }];

        var layout = {
            title: 'Total POs vs GRNs',
            height: 400,
            width: 500
        };

        Plotly.newPlot('chart', data, layout);
    </script>
</html>