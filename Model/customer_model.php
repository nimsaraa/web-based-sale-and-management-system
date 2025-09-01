<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Customer{
    
    
    public function addCustomer($fname,$lname,$email,$address) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO customer(cus_fname,cus_lname,cus_email,cus_address)VALUES ('$fname','$lname','$email','$address')";
        $con->query($sql) or die ($con->error);
        $cus_id=$con->insert_id;
        return $cus_id;
    }
    
    public function addCustomerContact($cus_id,$contact_no) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO customer_contact(contact_number,cus_id)VALUES ('$contact_no','$cus_id')";
        $con->query($sql) or die ($con->error);
         
    }
    
    public function getAllCustomers()
    {
         $con=$GLOBALS["con"];
         $sql="SELECT * FROM customer WHERE customer_status!=-1";
         $result= $con->query($sql) or die($con->error);
         return $result;
    }
    
       public function deleteCustomer($cus_id)
    {
         $con=$GLOBALS["con"];
         $sql="UPDATE customer SET customer_status='-1'"
                 . " WHERE cus_id='$cus_id'";
         $result= $con->query($sql) or die($con->error);
    }
    
        public function getCustomer($cus_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM customer  WHERE   cus_id='$cus_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
    }
    public function getCustomerContact($cus_id)
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM customer_contact WHERE cus_id='$cus_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
        
    }
    public function removeCustomerContacts($cus_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM customer_contact WHERE cus_id='$cus_id'";
             $result=$con->query($sql)or die($con->error);
             
         }
    
     public function UpdateCustomer($fname,$lname,$email,$address,$cus_id){
       
        $con=$GLOBALS["con"];
        $sql = "UPDATE customer SET "
                . "cus_fname='$fname',"
                . "cus_lname='$lname',"
                . "cus_email='$email',"
                . "cus_address='$address'"
                . " WHERE cus_id='$cus_id'";
        $con->query($sql) or die($con->error);
        
        
    }
    public function getActivateCustomerCount() {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(cus_id) as customer_count FROM customer WHERE customer_status=1 ;";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getCustomerCount() {
             $con=$GLOBALS["con"];
             $sql="SELECT COUNT(cus_id) as customer_count FROM customer "
                     . "  WHERE customer_status >='0'";
             $result = $con->query($sql) or die ($con->error);
             return $result; 
         }
         
    public function activateCustomer($cus_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE customer SET customer_status='1' WHERE cus_id='$cus_id'";
        $result = $con->query($sql) or die ($con->error);

         }
         
    public function deactivateCusotmer($cus_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE customer SET customer_status='0' WHERE cus_id='$cus_id'";
        $result = $con->query($sql) or die ($con->error);

         }      
    
    
    
    
}
