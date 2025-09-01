<?php
include '../commons/session.php';


$status = $_GET["status"];

include '../Model/customer_model.php';

$customerObj= new Customer();

switch($status){ 
    
    
    
case "add_customer":
        
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];

        try{
    if($fname=="")
    {
        
        throw new Exception("First Name cannot be Empty!!!!");
    }
            
            $cus_id=$customerObj->addCustomer($fname, $lname,$email,$address );
            $customerObj->addCustomerContact($cus_id,$cno1);
            $customerObj->addCustomerContact($cus_id,$cno2);
            
            
            $msg="customer $fname $lname Succesfully Added!";
            $msg= base64_encode($msg);
     
     
     ?>
    
     <script>
        window.location="../view/view-customers.php?msg=<?php echo $msg;  ?>";
    </script>
    
    <?php
         
         
     }

 catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-customer.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
            
  break;
  
   case "delete":
        
    $cus_id=$_GET["cus_id"];
    $cus_id= base64_decode($cus_id);
    $customerObj->deleteCustomer($cus_id);
    $customerObj->removeCustomerContacts($cus_id);
    $msg= "Successfully Deleted!!!";
    $msg= base64_encode($msg);
    ?>
     <script>
        window.location="../view/view-customers.php?msg=<?php echo $msg; ?>";
    </script>
        
        <?php
    break;

case "update_customer":
        
        $cus_id = $_POST["cus_id"];
    
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $address=$_POST["address"];
        $cno1 = $_POST["cno1"];
        $cno2 = $_POST["cno2"];
        
       
        
        
        try {
            if ($fname == "") {

                throw new Exception("First Name cannot be Empty!!!!");
            }
            
            
            
            $customerResult = $customerObj->getCustomer($cus_id);
            $customerrow = $customerResult->fetch_assoc();
           
        //update customer
        $customerObj->UpdateCustomer($fname, $lname, $email,$address, $cus_id);
        
        //delete existing contacts
        $customerObj->removeCustomerContacts($cus_id);
        
        //insert new contacts
        $customerObj->addCustomerContact($cus_id, $cno1);
        $customerObj->addCustomerContact($cus_id, $cno2);
        
        
        
        
        
        
        $msg = "Successfully updated!!!";
        $msg = base64_encode($msg);
        ?>
                 <script>
                    window.location="../view/view-customers.php?msg=<?php echo $msg; ?>";
                </script>
                    
            <?php
        }
        catch (Exception $ex) {
            
            $msg= $ex->getMessage();
            $msg= base64_encode($msg);
    ?>
              <script>
                            window.location="../view/edit-customer.php?msg=<?php echo $msg; ?>";
              </script>
    <?php
    

        }
   
        break;
        
                case "activate":
            $cus_id = $_GET["cus_id"];
            $cus_id = base64_decode($cus_id);
            $customerObj->activateCustomer($cus_id);
            $msg = "Successfully Activated!!!";
            $msg = base64_encode($msg);
            ?>
            <script>
            window.location="../view/view-customers.php?msg=<?php echo $msg; ?>";
            </script>
        <?php
        break;

        case "deactivate":
            $cus_id = $_GET["cus_id"];
            $cus_id = base64_decode($cus_id);
            $customerObj->deactivateCusotmer($cus_id);
            $msg = "Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-customers.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;

    
}
