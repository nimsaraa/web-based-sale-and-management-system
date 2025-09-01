<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Delivery{
    
     public function addVehicle($v_no,$v_type) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO vehicle(vehicle_no,vehicle_type)VALUES ('$v_no','$v_type')";
        $con->query($sql) or die ($con->error);
        $vehicle_id=$con->insert_id;
        return $vehicle_id;
    }
    
    public function getAllVehicles()
    {
         $con=$GLOBALS["con"];
         $sql="SELECT * FROM vehicle WHERE vehicle_status!=-1";
         $result= $con->query($sql) or die($con->error);
         return $result;
    }
    
    public function getVehicle($vehicle_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM vehicle  WHERE   vehicle_id='$vehicle_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
    }
    public function UpdateVehicle($v_no,$v_type,$vehicle_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE vehicle SET "
                . "vehicle_no='$v_no',"
                . "vehicle_type='$v_type'"
                . " WHERE vehicle_id='$vehicle_id'";
        $$result=$con->query($sql) or die($con->error);
        return $result;
        
        
    }
    
       public function deleteVehicle($vehicle_id)
    {
         $con=$GLOBALS["con"];
         $sql="UPDATE vehicle SET vehicle_status='-1'"
                 . " WHERE vehicle_id='$vehicle_id'";
         $result= $con->query($sql) or die($con->error);
         return $result;
    }
    
    public function addDelivery($order_id,$pay_type_id,$vehicle_id) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO delivery(order_id,pay_type_id,vehicle_id)VALUES ('$order_id','$pay_type_id','$vehicle_id')";
        $con->query($sql) or die ($con->error);
        $delivery_id=$con->insert_id;
        return $delivery_id;
    }
   public function getAllDeliveries()
{
    $con = $GLOBALS["con"];
    $sql = "SELECT d.*, p.payment_type, v.vehicle_no "
            . " FROM delivery d "
            . " JOIN payement_types p ON p.pay_type_id = d.pay_type_id"
            . " JOIN vehicle v ON v.vehicle_id = d.vehicle_id "
            . " WHERE d.delivery_status != -1";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getDelivery($delivery_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT d.*, p.payment_type, v.vehicle_no "
            . " FROM delivery d "
            . " JOIN payement_types p ON p.pay_type_id = d.pay_type_id"
            . " JOIN vehicle v ON v.vehicle_id = d.vehicle_id "
            . " WHERE   delivery_id='$delivery_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function Updatedelivery($order_id,$pay_type_id,$vehicle_id,$delivery_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE delivery SET "
                . "order_id='$order_id',"
                . "pay_type_id='$pay_type_id',"
                . "vehicle_id='$vehicle_id'"
                . " WHERE delivery_id='$delivery_id'";
        $result=$con->query($sql) or die($con->error);
        return $result;
        
        
    }
    
     public function deliveredStatus($delivery_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE delivery SET delivery_status='1' WHERE delivery_id='$delivery_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;

         }
         
         
       public function deleteDelivery($delivery_id)
    {
         $con=$GLOBALS["con"];
         $sql="UPDATE delivery SET delivery_status='-1'"
                 . " WHERE delivery_id='$delivery_id'";
         $result= $con->query($sql) or die($con->error);
         return $result;
    }
    
    
     public function getCompleteDeliveryCount() {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(delivery_id) as delivery_count FROM delivery WHERE delivery_status=1;";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getPendingDeliveryCount() {
             $con=$GLOBALS["con"];
             $sql="SELECT COUNT(delivery_id) as delivery_count FROM delivery WHERE delivery_status =0; ";
             $result = $con->query($sql) or die ($con->error);
             return $result; 
         }
         
}

