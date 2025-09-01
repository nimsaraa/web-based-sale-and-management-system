<?php

include_once '../commons/session.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$productObj = new Product();
$categoryResult= $productObj->getAllcategory();
$sizeResult= $productObj->getAllSizes();
$colourResult=$productObj->getAllColours();
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
                    
                    <form action="../Controller/product_controller.php?status=add_product" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3" id="msg">

                                </div>
                                <?php
                                if (isset($_GET["msg"])) {
                                    ?>
                                    <div class="col-md-6 col-md-offset-3 alert alert-danger" >
                                        <?php echo base64_decode($_GET["msg"]); ?>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>



                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Product Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="pname" id="pname" />
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="control-label">Description</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text"class="form-control" name="pdescription" id="pdescription" >
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            
                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Price (RS)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="price" id="price" min="0" required="required"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Category</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="category" id="category" class="form-control"  required="required">
                                        <option value="">---------</option>
                                        <?php
                                        while ($categoryRow = $categoryResult->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $categoryRow["p_cat_id"]; ?>">
                                                <?php echo $categoryRow["category_name"]; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row"> 
                                
                                <div class="col-md-2">
                                    <label class="control-label">Image 01</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" class="form-control" name="product_image1" id="product_image1" onchange="displayImage(this,'img_prev1');"/>
                                    <br>
                                    <img id="img_prev1">
                                </div>
                                 <div class="col-md-2">
                                    <label class="control-label">Image Title 01</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="Image_title1" id="Image_title1"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            <div class="row"> 
                                
                                <div class="col-md-2">
                                    <label class="control-label">Image 02</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" class="form-control" name="product_image2" id="product_image2" onchange="displayImage(this,'img_prev2');"/>
                                    <br>
                                    <img id="img_prev2">
                                </div>
                                 <div class="col-md-2">
                                    <label class="control-label">Image Title 02</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="Image_title2" id="Image_title2"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            <div class="row"> 
                                
                                <div class="col-md-2">
                                    <label class="control-label">Image 03</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" class="form-control" name="product_image3" id="product_image3" onchange="displayImage(this,'img_prev3');"/>
                                    <br>
                                    <img id="img_prev3">
                                </div>
                                 <div class="col-md-2">
                                    <label class="control-label">Image Title 03</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="Image_title3" id="Image_title3"/>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="control-label">Choose sizes</label>
                                </div>
                                 
        
                                <div class="col-md-4">
                                    <div class="row">
                                        <?php
                                        while ($size_row = $sizeResult->fetch_assoc()) {
                                            ?>
                                            <div class="col-md-2">
                                                <label>
                                                    <input type="checkbox" name="size[]" value="<?php echo $size_row['size_id']; ?>">
                                                    <?php echo $size_row["size"]; ?>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>


                                </div>
                                
                                <div class="col-md-2">
                                    <label class="control-label">Choose colours</label>
                                </div>
                                 
        
                                <div class="col-md-4">
                                    <div class="row">
                                        <?php
                                        while ($colour_row = $colourResult->fetch_assoc()) {
                                            ?>
                                            <div class="col-md-2">
                                                <label>
                                                    <input type="checkbox" name="colour[]" value="<?php echo $colour_row['colour_id']; ?>">
                                                    <?php echo $colour_row["colour"]; ?>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
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
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-offset-3 col-md-6">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="btn btn-danger" value="Reset"/>
                                </div>
                            </div>
                        </div>


                    </form>


                </div>
            </div>
            
        </div>
    </body>
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/productvalidation.js"></script>
    <script>
            function displayImage(input,imgId){
            if(input.files && input.files[0])
            {
               var reader = new FileReader();
               reader.onload = function (e){
               $("#" + imgId).attr('src',e.target.result).width(80).height(100);
               
               };
               reader.readAsDataURL(input.files[0]);
            }
        }
        </script>  
        
        
</html>
