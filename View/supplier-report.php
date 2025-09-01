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
        <script src="../JS/plotly-3.0.1.min.js" charset="utf-8"> </script>
    </head>
    <body>
        <div class="container">
            <?php
            $pageName = "SUPPLIER REPORTS";
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
            
       
        <div class="row">
                    <div class="col-md-12">
                        <center>
                        <h3> Supplier Involvement Report
                        <div id="tester" style="width:600px;height: 250px;"></div>
                        </h3>
                        </center>
                    </div>
                </div>
            
         </div>    
    </body>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
   <script>
                var data = [{
            values: [<?php echo $count_row["supplier_count"]; ?>,<?php echo $activate_row["supplier_count"]; ?> ],
            labels: ['Total Supplier Count', 'Active supplier Count'],
            type: 'pie'
            }];

        var layout = {
            height: 400,
            width: 500
            };

            Plotly.newPlot('tester', data, layout);

    </script>
    
</html>