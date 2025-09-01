<?php
include '../commons/session.php';


$status = $_GET["status"];

include '../Model/supplier_model.php';

$supplierObj= new Supplier();

switch($status){
    

    
    
    
    
    
    

    case "add_supplier":
        
        $sname = $_POST["sname"];
        
        $email = $_POST["email"];
        $address = $_POST["address"];
        $cno = $_POST["cno"];
        $natno = $_POST["natno"];
        

        try{
    if($sname=="")
    {
        
        throw new Exception("Supplier Name cannot be Empty!!!!");
    }
    
 
            $sup_id=$supplierObj->addSupplier($sname,$email,$address,$natno );
            $supplierObj->addSupplierContact($sup_id,$cno);
            
            
          
            
           
            
            $msg="Supplier $sname Succesfully Added!";
            $msg= base64_encode($msg);
     
     
     ?>
    
     <script>
        window.location="../view/view-suppliers.php?msg=<?php echo $msg;  ?>";
    </script>
    
    <?php
         
         
     }
     
 catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-supplier.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
            
  break;
  
    case "update_supplier":
        
        $sup_id=$_POST["sup_id"];
        $sname = $_POST["sname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $cno = $_POST["cno"];
        $natno = $_POST["natno"];
        
        
        
        try{
        //update supplier
        $supplierObj->UpdateSupplier($sup_id,$sname,$email,$address,$natno,$sup_id);
        
        //delete existing contact
                $supplierObj->removeSupplierContacts($sup_id);
                
         //insert new contact
                $supplierObj->addSupplierContact($sup_id,$cno);
        
        
        $msg="Supplier $sname Successfully updated!";
                $msg= base64_encode($msg);
                ?>
                        
                        <script>
                            window.location="../view/view-suppliers.php?msg=<?php echo $msg; ?>";
                        </script>
                        <?php
                        


            }
                
               
                
             catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/edit-supplier.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
        
        break;
  
  case "activate":
            $sup_id = $_GET["sup_id"];
            $sup_id = base64_decode($sup_id);
            $supplierObj->activateSupplier($sup_id);
            $msg = "Successfully Activated!!!";
            $msg = base64_encode($msg);
            ?>
            <script>
            window.location="../view/view-suppliers.php?msg=<?php echo $msg; ?>";
            </script>
        <?php
        break;

        case "deactivate":
            $sup_id = $_GET["sup_id"];
            $sup_id = base64_decode($sup_id);
            $supplierObj->deactivateSupplier($sup_id);
            $msg = "Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-suppliers.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
  
   case "delete":
        
    $sup_id=$_GET["sup_id"];
    $sup_id= base64_decode($sup_id);
    $supplierObj->deleteSupplier($sup_id);
    $msg= "Successfully Deleted!!!";
    $msg= base64_encode($msg);
    ?>
     <script>
        window.location="../view/view-suppliers.php?msg=<?php echo $msg; ?>";
    </script>
        
        <?php
  break;


    case "add_invoice":
        
        $sup_id = $_POST["supname"];
        $ino=$_POST["ino"];
        $invoice = $_FILES["invoice"];
   
    
 
        
        
        $file_name="";
            if(isset($_FILES["invoice"]))
            {
                if ($invoice["name"] !=""){
       
                    $file_name=time()."_".$_FILES["invoice"]["name"];
                    $path="../images/invoices/$file_name";
                    move_uploaded_file($invoice["tmp_name"], $path);
                    
                    
                }
                
            }
        
            try{
                     
        if($sup_id=="")
    {
        
        throw new Exception("Supplier Name cannot be Empty!!!!");
        
    }
    
    
 
            $supplierObj->addInvoice($sup_id,$ino,$file_name);
          
            $msg="invoice Succesfully Added!";
            $msg= base64_encode($msg);
     
     
     ?>
    
     <script>
        window.location="../view/supplier-invoice.php?msg=<?php echo $msg;  ?>";
    </script>
    
    <?php
         
         
     }
     
 catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/supplier-invoice.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
        
        
        break;
    
    
}

