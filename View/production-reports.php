<?php

include_once '../commons/session.php';
include_once '../Model/production_model.php';

$userrow = $_SESSION["user"];
$productionObj = new Production();
$summaryResult = $productionObj->getCompletedProductionSummaryByDate();

$dates = [];
$completed = [];

while ($row = $summaryResult->fetch_assoc()) {
    $dates[] = $row["production_date"];
    $completed[] = (int)$row["total_completed"];
}
?>

<html>
    <head>
        <?php include_once '../includes/bootstrap_css_includes.php'; ?>
        <script src="../JS/plotly-3.0.1.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php $pageName = "PRODUCTION REPORTS"; ?>
            <?php include_once '../includes/header_row_includes.php'; ?>
            <hr/>

            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Completed Production Summary</h3>
                    <div id="productionChart" style="width:100%; height:500px;"></div>
                </div>
            </div>
        </div>
    </body>

    <script>
    var dates = <?php echo json_encode($dates); ?>;
    var completed = <?php echo json_encode($completed); ?>;

    var trace = {
        x: dates,
        y: completed,
        type: 'scatter',
        mode: 'lines+markers',
        name: 'Completed Production',
        line: {
            color: 'green',
            width: 3
        },
        marker: {
            size: 6
        }
    };

    var layout = {
        title: 'Completed Production by Date',
        xaxis: {
            title: 'Production Date',
            tickangle: -45
        },
        yaxis: {
            title: 'Quantity Completed'
        },
        legend: {
            x: 0,
            y: 1.2,
            orientation: 'h'
        }
    };

    Plotly.newPlot('productionChart', [trace], layout);
</script>

</html>
