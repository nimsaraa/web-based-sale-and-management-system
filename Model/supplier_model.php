<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Supplier{
    
    public function addSupplier($sname,$email,$address,$natno) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO supplier(supplier_name,sup_email,sup_address,nat_no)VALUES ('$sname','$email','$address','$natno')";
        $con->query($sql) or die ($con->error);
        $sup_id=$con->insert_id;
        return $sup_id;
    }
    
    
    public function getAllSuppliers() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM supplier WHERE supplier_status!=-1";
        $result= $con->query($sql) or die($con->error);
        return $result;
        
        
    }
   
    
    public function addSupplierContact($sup_id,$contact_no) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO supplier_contact(contact_number,sup_id)VALUES ('$contact_no','$sup_id')";
        $result=$con->query($sql) or die ($con->error);
        return $result; 
    }
    
    public function getSupplier($sup_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM supplier  WHERE   sup_id='$sup_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
    }
    public function getSupplierContact($sup_id)
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM supplier_contact WHERE sup_id='$sup_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
        
    }
    
    public function activateSupplier($sup_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE supplier SET supplier_status='1' WHERE sup_id='$sup_id'";
        $result = $con->query($sql) or die ($con->error);

         }
         
    public function deactivateSupplier($sup_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE supplier SET supplier_status='0' WHERE sup_id='$sup_id'";
        $result = $con->query($sql) or die ($con->error);

         } 
         
         public function deleteSupplier($sup_id)
    {
         $con=$GLOBALS["con"];
         $sql="UPDATE supplier SET supplier_status='-1'"
                 . " WHERE sup_id='$sup_id'";
         $result= $con->query($sql) or die($con->error);
    }
    
     public function getActivateSupplierCount() {
        $con = $GLOBALS["con"];
        $sql = "SELECT COUNT(sup_id) as supplier_count FROM supplier WHERE supplier_status=1;";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getSupplierCount() {
             $con=$GLOBALS["con"];
             $sql="SELECT COUNT(sup_id) as supplier_count FROM supplier WHERE supplier_status >=0; ";
             $result = $con->query($sql) or die ($con->error);
             return $result; 
         }
         
         
    public function UpdateSupplier($sup_id,$sname,$email,$address,$natno) {

        $con = $GLOBALS["con"];
        $sql = "UPDATE supplier SET "
                . "supplier_name='$sname',"
                . "sup_email='$email',"
                . "sup_address='$address',"
                . "nat_no='$natno'"
                . " WHERE sup_id='$sup_id'";
        $con->query($sql) or die($con->error);
    }
    
    
    public function removeSupplierContacts($sup_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM supplier_contact WHERE sup_id='$sup_id'";
             $result=$con->query($sql)or die($con->error);
             
         }
         
    public function addInvoice($sup_id,$ino,$invoice) {
        $con= $GLOBALS["con"];
        $sql= "INSERT INTO supplier_invoice (sup_id, invoice_number, invoice) VALUES ('$sup_id','$ino','$invoice')";
        $result=$con->query($sql) or die ($con->error);
        return $result;
    }   
    public function getSupplierInvoice($sup_id)
    {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM supplier_invoice WHERE sup_id='$sup_id'";
        $result= $con->query($sql) or die($con->error);
        return $result;
        
    }
    
    
    public function getInvoiceCount($sup_id) {
             $con=$GLOBALS["con"];
             $sql="SELECT COUNT(invoice_number) as supplierinvoice_count FROM supplier_invoice WHERE  sup_id='$sup_id'; ";
             $result = $con->query($sql) or die ($con->error);
             return $result; 
         }
    
}
