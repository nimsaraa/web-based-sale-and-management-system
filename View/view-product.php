<?php

include '../commons/session.php';
include_once '../model/product_model.php';


$productObj=new Product();
$product_id=$_GET["product_id"];
$product_id=base64_decode($_GET["product_id"]);
$productResult=$productObj->getProduct($product_id);
$productdetailrow=$productResult->fetch_assoc();
$categoryResult = $productObj->getCategoryNameById($productdetailrow["category"]);
$categoryRow = $categoryResult->fetch_assoc();
$sizeResult=$productObj->getAllSizes();
$colourResult=$productObj->getAllColours();


$productimageresult=$productObj->getproductImageInfo($product_id);
$imagerow1=$productimageresult->fetch_assoc();
$imagerow2=$productimageresult->fetch_assoc();
$imagerow3=$productimageresult->fetch_assoc();
$titlerow1=$productimageresult->fetch_assoc();
$titlerow2=$productimageresult->fetch_assoc();
$titlerow3=$productimageresult->fetch_assoc();

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


$userrow = $_SESSION["user"];
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
                    
                    <div class="col-md-9">
                        <div class="row">
                            
                            <div class="row">
                                <h2>Product Details</h2>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Product Name</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3><?php echo $productdetailrow["product_name"];?></h3>
                                </div>
                            </div>
                         <div class="row">
                            &nbsp;
                        </div>
                        
                         <div class="row">
                                <div class="col-md-6">
                                    <h3>Product Price (RS)</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3><?php echo number_format( $productdetailrow["price"], 2 );?></h3>
                                </div>
                            </div>
                         <div class="row">
                            &nbsp;
                        </div>
                        
                         <div class="row">
                                <div class="col-md-6">
                                    <h3>Description</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3><?php echo $productdetailrow["description"];?></h3>
                                </div>
                            </div>
                         <div class="row">
                            &nbsp;
                        </div>
                        
                         <div class="row">
                                <div class="col-md-6">
                                    <h3>Product category</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3><?php echo $categoryRow["category_name"]; ?></h3>

                                </div>
                            </div>
                         <div class="row">
                            &nbsp;
                        </div>
                        
                        <div class="row">
                                <div class="col-md-6">
                                    <h3>Product Sizes</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php
                                        while ($size_row = $sizeResult->fetch_assoc()) {
                                            ?>
                                            <div class="col-md-2">
                                               
                                                    <input type="checkbox" name="size[]" value="<?php echo $size_row['size_id']; ?>" onclick="return false;" readonly="readonly"
                                                           
                                                          
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
                            </div>
                         <div class="row">
                            &nbsp;
                        </div>
                        
                        <div class="row">
                                <div class="col-md-6">
                                    <h3>Product Colours</h3>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <?php
                                        while ($colour_row = $colourResult->fetch_assoc()) {
                                            ?>
                                            <div class="col-md-2">
                                               
                                                    <input type="checkbox" name="colour[]" value="<?php echo $colour_row['colour_id']; ?>" onclick="return false;" readonly="readonly"
                                                           
                                                          
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
                            &nbsp;
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4" >
                             <?php
                                    if ($imagerow1["p_image"] != "") {
                                        $image = $imagerow1["p_image"];
                                        ?>
                                        <img id="img_prev1" style="" src="../images/product_images/<?php echo $image; ?>"
                                             width="200px" height="200px"/>
                                             <?php
                                         }
                                         ?>
                            </div>
                            <div class="">
                                <h3>
                                    
                                </h3>
                            </div>
                            
                    
                        
                            <div class="col-md-4" >
                             <?php
                                    if ($imagerow2["p_image"] != "") {
                                        $image = $imagerow2["p_image"];
                                        ?>
                                        <img id="img_prev1" style="" src="../images/product_images/<?php echo $image; ?>"
                                             width="200px" height="200px"/>
                                             <?php
                                         }
                                         ?>
                            </div>
                            <div class="">
                                
                            </div>
                            
                        
                        
                            <div class="col-md-4" >
                             <?php
                                    if ($imagerow3["p_image"] != "") {
                                        $image = $imagerow3["p_image"];
                                        ?>
                                        <img id="img_prev1" style="" src="../images/product_images/<?php echo $image; ?>"
                                             width="200px" height="200px"/>
                                             <?php
                                         }
                                         ?>
                            </div>
                            <div class="">
                                
                            </div>
                            
                                </div>
                            
                        
                            
                        
                        
                    </div>
                    
                    
                    
            
            
        </div>
    </body>
</html>