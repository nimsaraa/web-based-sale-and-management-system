<?php

include_once '../commons/session.php';
include_once '../Model/order_model.php';


$userrow = $_SESSION["user"];
$orderObj=new Order();
$salesResult = $orderObj->getTotalSalesByDate();

$dates = [];
$totals = [];

while ($row = $salesResult->fetch_assoc()) {
    $dates[] = $row["order_date"];
    $totals[] = $row["daily_total"];
}
?>



<html>
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
        <script src="../JS/plotly-3.0.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
            $pageName = "ORDER MANAGEMENT";
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
                                <a href="view-orders.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-order.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add order
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="order-reports.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    Reports
                                </a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3>Daily Sales Summary</h3>
                            <div id="salesChart" style="width:100%; height:500px;"></div>
                        </div>
                    </div>
                </div>






            </div>
        </div>


    </div>
    </body>
    <script>
    var dates = <?php echo json_encode($dates); ?>;
    var totals = <?php echo json_encode($totals); ?>;

    var data = [{
        x: dates,
        y: totals,
        type: 'scatter',
        mode: 'lines+markers',
        line: {  width: 3 },
        marker: { size: 6 }
    }];

    var layout = {
        title: 'Total Sales by Date (RS)',
        xaxis: { title: 'Order Date' },
        yaxis: { title: 'Total Sales (RS)' }
        
    };

    Plotly.newPlot('salesChart', data, layout);
</script>
         
</html>