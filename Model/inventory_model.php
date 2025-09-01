<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Stock{
    
   public function addStock($sku_id,$quantity,$pro_id,$relevel) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO stock(sku_id,quantity,pro_id,reorder_level)VALUES ('$sku_id','$quantity','$pro_id','$relevel')";
        $con->query($sql) or die ($con->error);
        $stock_id=$con->insert_id;
        return $stock_id;
    }
    
    
    public function getAllStock() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM stock";
        $result=$con->query($sql)or die($con->error);
        return $result;
        
    }
    
    
   public function getQuntitySum() {
    $con = $GLOBALS['con'];
    $sql = "SELECT sku_id, SUM(quantity) AS total_quantity FROM stock GROUP BY sku_id";
    $result = $con->query($sql) or die($con->error);
    return $result;
    }
    
    public function addRaw($raw_name,$sup_id) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO raw_material(raw_name,sup_id)VALUES ('$raw_name','$sup_id')";
        $con->query($sql) or die ($con->error);
        $raw_id=$con->insert_id;
        return $raw_id;
    }
    public function getAllRaw() {
        $con=$GLOBALS["con"];
        $sql="SELECT r.raw_name,r.raw_id,s.Supplier_name FROM raw_material r INNER JOIN supplier s ON r.sup_id=s.sup_id WHERE raw_status !=-1";
        $result=$con->query($sql)or die($con->error);
        return $result;
        
    }
    
    public function deleteRaw($raw_id)
    {
         $con=$GLOBALS["con"];
         $sql="UPDATE raw_material SET raw_status='-1' WHERE raw_id='$raw_id'";
         $result= $con->query($sql) or die($con->error);
         return $result;
    }
    
    public function getraw($raw_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM raw_material r, supplier s WHERE r.sup_id=s.sup_id AND  raw_id='$raw_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
    }
    
    
    public function UpdateRaw($raw_id,$rname,$supplier_name) {

        $con = $GLOBALS["con"];
        $sql = "UPDATE raw_material SET "
                . "raw_name='$rname',"
                . "sup_id='$supplier_name'"
                . " WHERE raw_id='$raw_id'";
        $con->query($sql) or die($con->error);
    }
    
    public function getAllRawStock() {
        $con=$GLOBALS["con"];
        $sql="SELECT  rs.* , u.unit_name"
                . " FROM raw_stock rs "
                . "LEFT JOIN units u ON rs.unit_id = u.unit_id";
        $result=$con->query($sql)or die($con->error);
        return $result;
        
    }
    
    public function getRawQuntitySum() {
    $con = $GLOBALS['con'];
    $sql = "SELECT raw_id, SUM(quantity) AS total_quantity FROM raw_stock GROUP BY raw_id";
    $result = $con->query($sql) or die($con->error);
    return $result;
    }
    
    public function addRawStock($raw_id,$quantity,$unit_id,$relevel) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO raw_stock(raw_id,quantity,unit_id,reorder_level)VALUES ('$raw_id','$quantity','$unit_id','$relevel')";
        $con->query($sql) or die ($con->error);
        $raw_stock_id=$con->insert_id;
        return $raw_stock_id;
    }
    
   public function getReorderstock() {
    $con = $GLOBALS['con'];

    $sql = "SELECT  s.sku_id,  p.product_name,  c.colour,  si.size,  SUM(st.quantity) AS total_quantity,  MAX(st.reorder_level) AS reorder_level
            FROM stock st
            JOIN sku s ON st.sku_id = s.sku_id
            JOIN product p ON s.product_id = p.product_id
            JOIN colour c ON s.colour_id = c.colour_id
            JOIN size si ON s.size_id = si.size_id
            GROUP BY s.sku_id
            HAVING total_quantity < reorder_level";

    $result = $con->query($sql) or die($con->error);
    return $result;
}


    
    public function getReorderRaws() {
        $con = $GLOBALS['con'];
        $sql = "SELECT st.*, r.raw_name,u.unit_name, SUM(st.quantity) AS total_quantity,  MAX(st.reorder_level) AS reorder_level "
                . " FROM raw_stock st "
                . "JOIN units u ON u.unit_id=st.unit_id "
                . " JOIN raw_material r ON st.raw_id = r.raw_id"
                . " GROUP BY st.raw_id "
                . " HAVING total_quantity < reorder_level";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function getProductStock() {
        $con = $GLOBALS['con'];
        $sql = "SELECT st.*, p.product_name, c.colour, si.size, st.pro_id, SUM(st.quantity) AS quantity
            FROM stock st
            JOIN sku s ON st.sku_id = s.sku_id
            JOIN product p ON s.product_id = p.product_id
            JOIN colour c ON s.colour_id = c.colour_id
            JOIN size si ON s.size_id = si.size_id
            GROUP BY s.sku_id , st.pro_id";
            
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
    
    public function getRawStock() {
        $con = $GLOBALS['con'];
        $sql = "SELECT st.*, r.raw_name,s.Supplier_name,u.unit_name, SUM(st.quantity) AS quantity "
                . " FROM raw_stock st "
                . " JOIN raw_material r ON st.raw_id = r.raw_id "
                . "JOIN units u ON u.unit_id=st.unit_id "
                . " JOIN supplier s ON r.sup_id=s.sup_id "
                . " GROUP BY st.raw_id";
                
            
        $result = $con->query($sql) or die($con->error);
        return $result;
        
    }
    public function getAllUnits() {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM units";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
     public function clearStock($sku_id) {
    $con = $GLOBALS['con'];
    $sql = "DELETE FROM stock WHERE sku_id='$sku_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
    }
    
     public function clearRaw($raw_id) {
    $con = $GLOBALS['con'];
    $sql = "DELETE FROM raw_stock WHERE raw_id='$raw_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}


public function getReorderLeveltock() {
    $con = $GLOBALS['con'];

    $sql = "SELECT  s.sku_id,  p.product_name,  c.colour,  si.size,  SUM(st.quantity) AS total_quantity,  MAX(st.reorder_level) AS reorder_level
            FROM stock st
            JOIN sku s ON st.sku_id = s.sku_id
            JOIN product p ON s.product_id = p.product_id
            JOIN colour c ON s.colour_id = c.colour_id
            JOIN size si ON s.size_id = si.size_id
            GROUP BY s.sku_id
            HAVING total_quantity < reorder_level";

    $result = $con->query($sql) or die($con->error);
    return $result;
}



}


    
