<?php

include_once '../commons/session.php';
include_once '../Model/product_model.php';


$userrow = $_SESSION["user"];
$productObj = new Product();
$result = $productObj->getProductCountByCategory();

$categories = [];
$product_counts = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category_name'];
    $product_counts[] = (int)$row['product_count'];
}
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
            $pageName = "PRODUCT MANAGEMENT"
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
                <div class="col-md-12"  >

                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="product.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View products
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center" >
                                <a href="add-product.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add product
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="products-report.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Generate products report
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <h3 class="text-center">Available Products Count by Category</h3>
                        <div id="barChart" style="width: 100%; height: 500px;"></div>
                    </div>

                </div>
            </div>
            
        </div>
    </body>
    <script>
        var data = [{
            x: <?php echo json_encode($categories); ?>,
            y: <?php echo json_encode($product_counts); ?>,
            type: 'bar',
            
        }];

        var layout = {
            
            xaxis: {
                title: 'Category',
                
            },
            yaxis: {
                title: 'Count',
                
                
            },
            margin: {
                t: 50,
                b: 50
            }
        };

        Plotly.newPlot('barChart', data, layout, {responsive: true});
    </script>
    
    
</html>