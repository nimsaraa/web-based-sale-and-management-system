<?php

include_once '../commons/session.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$productObj = new Product();



$producResult = $productObj->getAllProducts();

$categoryResult= $productObj->getAllcategory();

$categoryRow=$categoryResult->fetch_assoc();
        
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
                        <div class="row">
                            <div class="col-md-12">
                                <table  class="table table-hover" id="producttable">
                                    <thead class="thead-dark">
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Price (RS)</th>
                                    <th>Category</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   
                                while($productrow=$producResult->fetch_assoc()){
                                    
                                    $product_id=$productrow["product_id"];
                                    $product_id= base64_encode($product_id);
                                  
                                ?>
                                <tr>
                                   
                                    <td>
                                        <?php
                                                 echo  $productrow["product_name"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo number_format($productrow["price"], 2)  ;
                                        ?>
                                    </td>
                                    <td>
                                            <?php
                                            $categoryResult = $productObj->getCategoryNameById($productrow["category"]);
                                            $categoryRow = $categoryResult->fetch_assoc();
                                            echo $categoryRow["category_name"];
                                            ?>
                                    </td>
                                    <td>
                                        
                                        <a href="view-product.php?product_id=<?php echo $product_id; ?>" class="btn btn-info">
                                                View
                                                &nbsp;
                                                <span class="glyphicon glyphicon-search">
                                                </span>
                                            </a>
                                        <a href="edit-product.php?product_id=<?php echo $product_id;?>" class="btn btn-warning">
                                                Edit
                                                &nbsp;
                                                <span class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a>
                                        <a href="../controller/product_controller.php?status=delete_product&product_id=<?php echo $product_id; ?>" class="btn btn-danger">
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
        $("#producttable").DataTable();
    });
    
    
    </script>
</html>
