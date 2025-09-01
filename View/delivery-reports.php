<?php

include_once '../commons/session.php';
include_once '../Model/delivery_model.php';

$userrow = $_SESSION["user"];

$delobj = new Delivery();

$deliverResult = $delobj->getPendingDeliveryCount();
$delivery_row = $deliverResult->fetch_assoc();

$countResult = $delobj->getCompleteDeliveryCount();
$count_row = $countResult->fetch_assoc();

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
    $pageName = "DELIVERY REPORTS";
    ?>
    <?php
    include_once '../includes/header_row_includes.php';
    ?>
    <script src="../JS/plotly-3.0.1.min.js" charset="utf-8"> </script>
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
                        <a href="view-deliverys.php">
                            <span class="glyphicon glyphicon-search"></span> &nbsp;
                            View delivery
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="add-delivery.php">
                            <span class="glyphicon glyphicon-plus"></span> &nbsp;
                            Assign delivery
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="add-vehicle.php">
                            <span class="glyphicon glyphicon-plus"></span> &nbsp;
                            Add vehicle
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="view-vehicles.php">
                            <span class="glyphicon glyphicon-search"></span> &nbsp;
                            View vehicles
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="delivery-reports.php">
                            <span class="glyphicon glyphicon-book"></span> &nbsp;
                            Reports
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <center>
                        <h3> Delivery Report
                            <div id="tester" style="width:600px;height: 250px;"></div>
                        </h3>
                    </center>
                </div>
            </div>


        </div>
    </div>


</div>
</body>

<script src="../bootstrap/js/bootstrap.min.js"></script>
<script>
    var data = [{
        values: [<?php echo $count_row["delivery_count"]; ?>, <?php echo $delivery_row["delivery_count"]; ?>],
        labels: ['Total delivered Count', 'Pending Count'],
        type: 'pie'
    }];

    var layout = {
        height: 400,
        width: 500
    };

    Plotly.newPlot('tester', data, layout);

</script>
</html>
