<?php
include '../commons/session.php';


$status = $_GET["status"];

include '../Model/product_model.php';

$productObj= new Product();

switch($status){ 
     
case "add_product":
        
$pname  =$_POST["pname"];
$pdescription =$_POST["pdescription"];
$price =$_POST["price"];
$category=$_POST["category"];
$sizes = $_POST["size"];
$colours=$_POST["colour"];
$product_image1=$_FILES["product_image1"];
$product_image2=$_FILES["product_image2"];
$product_image3=$_FILES["product_image3"];
$image_title1=$_POST["Image_title1"];
$image_title2=$_POST["Image_title2"];
$image_title3=$_POST["Image_title3"];

try{
   
            ///images upload
     $file_name1="";
            if(isset($_FILES["product_image1"]))
            {
                if ($product_image1["name"] !=""){
       
                    $file_name1=time()."_".$_FILES["product_image1"]["name"];
                    $path="../images/product_images/$file_name1";
                    move_uploaded_file($product_image1["tmp_name"], $path);
                    
                    
                }
                
            }
    $file_name2="";
            if(isset($_FILES["product_image2"]))
            {
                if ($product_image2["name"] !=""){
       
                    $file_name2=time()."_".$_FILES["product_image2"]["name"];
                    $path="../images/product_images/$file_name2";
                    move_uploaded_file($product_image2["tmp_name"], $path);
                    
                    
                }
                
            }
            $file_name3="";
            if(isset($_FILES["product_image3"]))
            {
                if ($product_image3["name"] !=""){
       
                    $file_name3=time()."_".$_FILES["product_image3"]["name"];
                    $path="../images/product_images/$file_name3";
                    move_uploaded_file($product_image3["tmp_name"], $path);
                    
                    
                }
                
            }
    
    
            $product_id=$productObj->addProduct($pname,$pdescription,$price,$category );
            
            foreach ($sizes as $size_id) {
                foreach ($colours as $colour_id) {
                    $productObj->addSku($product_id, $size_id, $colour_id);
                }
            }



            $productObj->addproductImage($product_id, $file_name1, $image_title1);
            $productObj->addproductImage($product_id, $file_name2, $image_title2);
            $productObj->addproductImage($product_id, $file_name3, $image_title3);
       
           
            
            $msg="product $pname Succesfully Added!";
            $msg= base64_encode($msg);
     
     
     ?>
    
     <script>
        window.location="../view/product.php?msg=<?php echo $msg;  ?>";
    </script>
    
    <?php
         
         
     

        
}
        
 catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-product.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
   

        break; 
        
        
        case"delete_product":
             $product_id = $_GET["product_id"];
            $product_id = base64_decode($product_id);
            $productObj->deleteProduct($product_id);
            $productObj->removesku($product_id);
            $msg = "Successfully Deleted!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/product.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
        
        
 case"update_product":
     
        $product_id = $_POST["product_id"];
        $pname = $_POST["pname"];
        $pdescription = $_POST["pdescription"];
        $price = $_POST["price"];
        $category = $_POST["category"];
        $sizes=$_POST["size"];
        $colours=$_POST["colour"];
        $product_image1 = $_FILES["product_image1"];
        $product_image2 = $_FILES["product_image2"];
        $product_image3 = $_FILES["product_image3"];
        $image_title1 = $_POST["Image_title1"];
        $image_title2 = $_POST["Image_title2"];
        $image_title3 = $_POST["Image_title3"];
        
        
        try{
           
           
            
            $producResult=$productObj->getProduct($product_id);
            $productrow=$producResult->fetch_assoc();

            $imageResult=$productObj->getproductImageInfo($product_id);
            $imagerow1=$imageResult->fetch_assoc();
            $imagerow2=$imageResult->fetch_assoc();
            $imagerow3=$imageResult->fetch_assoc();

            $titleResult=$productObj->getproductImageInfo($product_id);
            $titlerow1=$titleResult->fetch_assoc();
            $titlerow2=$titleResult->fetch_assoc();
            $titlerow3=$titleResult->fetch_assoc();
             $prev_image1 = $imagerow1["p_image"];
             $prev_image2 = $imagerow2["p_image"];
             $prev_image3 = $imagerow3["p_image"];

            
                 $img1=$prev_image1;
                      
                            if ($_FILES["product_image1"]["name"] != "") {

                                $img1 = time() . "_" . $_FILES["product_image1"]["name"];
                                $path = "../images/product_images/";
                                move_uploaded_file($_FILES["product_image1"]["tmp_name"], $path."$img1");
                                
                                //remove
                                 if(file_exists($path.$prev_image1)&& $prev_image1!="")
                        {
                            unlink($path.$prev_image1);
                        }
                        
                            }
                            else{
                                $img1=$prev_image1;
                            }
                        
                        
                        $img2=$prev_image2;
                     
                            if ($_FILES["product_image2"]["name"] != "") {

                                $img2 = time() . "_" . $_FILES["product_image2"]["name"];
                                $path = "../images/product_images/";
                                move_uploaded_file($_FILES["product_image2"]["tmp_name"], $path."$img2");
                                
                                //remove
                                 if(file_exists($path.$prev_image2)&& $prev_image2!="")
                        {
                            unlink($path.$prev_image2);
                        }
                        
                            }
                            else{
                                $img2=$prev_image2;
                            }
                        
                        $img3=$prev_image3;
                        
                       
                            if ($_FILES["product_image3"]["name"] != "") {

                                $img3 = time() . "_" . $_FILES["product_image3"]["name"];
                                $path = "../images/product_images/";
                                move_uploaded_file($_FILES["product_image3"]["tmp_name"], $path."$img3");
                                
                                //remove
                                 if(file_exists($path.$prev_image3)&& $prev_image3!="")
                        {
                            unlink($path.$prev_image3);
                        }
                        
                            }
                            else{
                                $img3=$prev_image3;
                            }
                        
           //delete existing sizes             
         $productObj->removeSku($product_id);  
          //addding updated fucntions
                
                
             foreach ($sizes as $s) {
                foreach ($colours as $c) {
                    $productObj->addSku($product_id, $s, $c);
                }
            }

                        //update product
        $productObj->UpdateProduct($pname, $pdescription, $price, $category, $product_id);
        
        $productObj->removeproductImages($product_id);
        $productObj->addproductImage($product_id, $img1, $image_title1);
        $productObj->addproductImage($product_id, $img2, $image_title2);
        $productObj->addproductImage($product_id, $img3, $image_title3);
        
        
        $msg="Successfully updated!";
        $msg= base64_encode($msg);
        ?>
                            <script>
                                    window.location="../view/product.php?msg=<?php echo $msg; ?>";
                            </script>
                        <?php
                        
        
        
        }
         catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/edit-product.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
   
        

        break;
        
}

  
         



 
 
 
 
