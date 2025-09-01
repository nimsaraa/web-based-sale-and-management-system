<?php

include_once '../commons/session.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$productObj = new Product();
$categoryResult= $productObj->getAllcategory();

$product_id= base64_decode($_GET["product_id"]);
$producResult=$productObj->getProduct($product_id);
$productrow=$producResult->fetch_assoc();
$sizeResult=$productObj->getAllSizes();
$colourResult=$productObj->getAllColours();

$imageResult=$productObj->getproductImageInfo($product_id);
$imagerow1=$imageResult->fetch_assoc();
$imagerow2=$imageResult->fetch_assoc();
$imagerow3=$imageResult->fetch_assoc();

$titleResult=$productObj->getproductImageInfo($product_id);
$titlerow1=$titleResult->fetch_assoc();
$titlerow2=$titleResult->fetch_assoc();
$titlerow3=$titleResult->fetch_assoc();

//get already assigned sizes

$sizeArray=array();
$skuSizeResult=$productObj->getSku($product_id);
while ($size_row=$skuSizeResult->fetch_assoc()){
    array_push($sizeArray,$size_row["size_id"]);
}

//get already assigned colours
$colourArray=array();
$skuColourResult=$productObj->getSku($product_id);
while ($colour_row=$skuColourResult->fetch_assoc()){
    array_push($colourArray,$colour_row["colour_id"]);
}


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
            $pageName = "EDIT PRODUCT"
                    
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
                    
                    <form action="../Controller/product_controller.php?status=update_product" method="post" enctype="multipart/form-data">
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
                                    <input type="hidden" class="product_id"  name="product_id" value="<?php echo $product_id ?>" />
                                    <input type="text" class="form-control" name="pname" id="pname" value="<?php echo $productrow["product_name"]; ?>" />
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="control-label">Description</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="pdescription" id="pdescription"  value="<?php echo $productrow["description"]; ?>">
                                  
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
                                    <input type="text" class="form-control" name="price" id="price" value="<?php echo $productrow["price"]; ?>" />
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Category</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="category" id="category" class="form-control"  required="required" >
                                        <option value="">---------</option>
                                        <?php
                                        while ($categoryRow = $categoryResult->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $categoryRow["p_cat_id"]; ?>"
                                                    <?php 
                                                    if($categoryRow["p_cat_id"]==$productrow["category"]){
                                                        ?> selected
                                                        <?php
                                                    }
                                                    ?>
                                        
                                                    
                                                    >
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
                                    <input type="file" class="form-control" name="product_image1" id="product_image1" onchange="displayImage(this,'img_prev1');">
                                 
                                    <br>
                                       <?php
                                    if ($imagerow1["p_image"] != "") {
                                        $image = $imagerow1["p_image"];
                                        ?>
                                        <img id="img_prev1" style="" src="../images/product_images/<?php echo $image; ?>"
                                             width="60px" height="80px"/>
                                             <?php
                                         }
                                         ?>
                                 
                                </div>
                                 <div class="col-md-2">
                                    <label class="control-label">Image Title 01</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="Image_title1" id="Image_title1"
                                            <?php
                                    if ($titlerow1 != null) {
                                        ?>
                                               value="<?php echo $titlerow1["image_title"]; ?>"
                                               <?php
                                           }
                                           ?>
                                           />
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
                                            <?php
                                    if ($imagerow2["p_image"] != "") {
                                        $image = $imagerow2["p_image"];
                                        ?>
                                        <img id="img_prev2" style="" src="../images/product_images/<?php echo $image; ?>"
                                             width="60px" height="80px"/>
                                             <?php
                                         }
                                         ?>
                                 
                                </div>
                                 <div class="col-md-2">
                                    <label class="control-label">Image Title 02</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="Image_title2" id="Image_title2"
                                                       <?php
                                    if ($titlerow2 != null) {
                                        ?>
                                               value="<?php echo $titlerow2["image_title"]; ?>"
                                               <?php
                                           }
                                           ?>
                                           />
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
                                            <?php
                                if($imagerow3["p_image"]!=""){
                                    $image= $imagerow3["p_image"];
                                ?>
                            <img id="img_prev3" style="" src="../images/product_images/<?php echo $image;  ?>"
                                 width="60px" height="80px"/>
                                <?php 
                                }
                                ?>
                                    
                                </div>
                                 <div class="col-md-2">
                                    <label class="control-label">Image Title 03</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="Image_title3" id="Image_title3"
                                                       <?php
                                    if ($titlerow3 != null) {
                                        ?>
                                               value="<?php echo $titlerow3["image_title"]; ?>"
                                               <?php
                                           }
                                           ?>
                                           />
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
                                               
                                                    <input type="checkbox" name="size[]" value="<?php echo $size_row['size_id']; ?>"
                                                          
                                                    <?php 
                                                    //already assigned sizes to check boxes
                                                    if (in_array($size_row["size_id"], $sizeArray)){
                                                    ?>
                                                    checked
                                                    <?php
                                                    }
                                                    ?>
                                                    />
                                                
                                                <?php echo $size_row["size"];?>
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
                                               
                                                    <input type="checkbox" name="colour[]" value="<?php echo $colour_row['colour_id']; ?>"
                                                          
                                                    <?php 
                                                    //already assigned colours to check boxes
                                                    if (in_array($colour_row["colour_id"], $colourArray)){
                                                    ?>
                                                    checked
                                                    <?php
                                                    }
                                                    ?>
                                                    />
                                                
                                                <?php echo $colour_row["colour"];?>
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
