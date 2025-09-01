<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Product{
    
    public function getAllcategory(){
        
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM product_category";
        $result=$con->query($sql)or die($con->error);
        return $result;
    }
    
    public function getAllSku() {
    $con = $GLOBALS["con"];
    $sql = "SELECT sku.sku_id, p.product_name, s.size, c.colour
            FROM sku 
            INNER JOIN product p ON sku.product_id = p.product_id
            INNER JOIN size s ON sku.size_id = s.size_id
            INNER JOIN colour c ON sku.colour_id = c.colour_id";

    $result = $con->query($sql) or die($con->error);
    return $result;
}

        
    
    public function getAllSizes() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM size";
        $result=$con->query($sql)or die($con->error);
        return $result;
        
    }
    
     public function getAllColours() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM colour";
        $result=$con->query($sql)or die($con->error);
        return $result;
        
    }
    
    


    public function addProduct($pname,$pdescription,$price,$category) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO product(product_name,description,price,category)VALUES ('$pname','$pdescription','$price','$category')";
        $con->query($sql) or die ($con->error);
        $product_id=$con->insert_id;
        return $product_id;
        
        
    }
    
    
    public function addproductImage($product_id,$product_image,$image_title) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO product_image (p_image,image_title,product_id) VALUES ('$product_image','$image_title','$product_id')";
        $con->query($sql) or die ($con->error);
        
    }
    public function addSku($product_id,$size_id,$colour_id) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO sku (product_id,size_id,colour_id)VALUES ('$product_id','$size_id','$colour_id')";
        $con->query($sql) or die ($con->error);
   
    }
    public function removeSku($product_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM sku WHERE product_id='$product_id'";
             $result=$con->query($sql)or die($con->error);
         }

    public function getSku($product_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM sku WHERE product_id='$product_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getSkuDetails($sku_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT sku.sku_id, p.product_name, s.size, c.colour
                FROM sku 
                INNER JOIN product p ON sku.product_id = p.product_id
                INNER JOIN size s ON sku.size_id = s.size_id
                INNER JOIN colour c ON sku.colour_id = c.colour_id
                WHERE sku_id='$sku_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    

   

    public function getAllProducts() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM product WHERE product_status !=-1";
        $result = $con->query($sql) or die ($con->error);
        return $result;
        
    }
    
    public function getProduct($product_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM product  WHERE   product_id='$product_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
             
         }
         public function getCategoryNameById($categoryId) {
        $con =$GLOBALS["con"];
        $sql = "SELECT category_name FROM product_category WHERE p_cat_id = '$categoryId'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
    }

         
    public function getproductImageInfo($product_id){
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM product_image WHERE product_id='$product_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
        
    }
     public function deleteProduct($product_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE product SET product_status='-1' WHERE product_id='$product_id'";
        $result = $con->query($sql) or die ($con->error);

         }
    
    public function UpdateProduct($pname,$pdescription,$price,$category,$product_id) {
          $con=$GLOBALS["con"];
          $sql="UPDATE product SET product_name='$pname',"
                  . "description='$pdescription',"
                  . "price='$price',"
                  . "category='$category'  WHERE product_id='$product_id' ";
          $con->query($sql) or die ($con->error);
        
    }
  
      public function removeproductImages($product_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM product_image  WHERE product_id='$product_id'";
             $result=$con->query($sql)or die($con->error);
             
         }
         public function getProductCountByCategory() {
    $con = $GLOBALS["con"];
    $sql = "SELECT pc.category_name, COUNT(p.product_id) AS product_count
            FROM product_category pc
            LEFT JOIN product p ON p.category = pc.p_cat_id AND p.product_status != -1
            GROUP BY pc.p_cat_id, pc.category_name";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

     
    
  
    
    
    
    
    
    
    
    
}