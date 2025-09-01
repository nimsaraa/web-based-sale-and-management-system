<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Production{
    
    public function addProduction($sku_id,$pdescription,$pdate,$pqty) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO production(sku_id,description,p_date,p_qty)VALUES ('$sku_id','$pdescription','$pdate','$pqty')";
        $con->query($sql) or die ($con->error);
        $pro_id=$con->insert_id;
        return $pro_id;
        
        
    }
    public function getAllProductions() {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM production";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function deleteProduction($pro_id) {
        $con = $GLOBALS["con"];
        $sql = "DELETE FROM production  WHERE pro_id='$pro_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getproduction($pro_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM production WHERE pro_id='$pro_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function UpdateProduction($sku_id,$pdescription,$pdate,$pqty,$pro_id) {
          $con=$GLOBALS["con"];
          $sql="UPDATE production SET sku_id='$sku_id',"
                  . "description='$pdescription',"
                  . "p_date='$pdate',"
                  . "p_qty='$pqty'  WHERE pro_id='$pro_id' ";
          $con->query($sql) or die ($con->error);
        
    }
    public function complete($pro_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE production SET p_status='1' WHERE pro_id='$pro_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;

         }
         
    public function ongoing($pro_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE production SET p_status='0' WHERE pro_id='$pro_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;

         } 
         
         public function getOngoingProductions() {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM production WHERE p_status='0'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getCompletedProductions() {
        $con = $GLOBALS["con"];
        $sql = "SELECT * FROM production WHERE p_status='1'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getCompletedProductionSummaryByDate() {
    $con = $GLOBALS["con"];
    $sql = "SELECT  p_date AS production_date, SUM(p_qty) AS total_completed "
            . "FROM  production"
            . " WHERE   p_status = 1 "
            . " GROUP BY  p_date "
            . " ORDER BY   p_date ASC";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

  
    
        
    
}
    