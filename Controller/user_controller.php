<?php
include '../commons/session.php';

 if(!isset($_GET["status"])){
    ?>
    <script>
        window.location="../view/login.php";
    </script>
    <?php
 }

$status = $_GET["status"];

include '../Model/user_model.php';
include '../Model/login_model.php';
$userObj= new User();
$loginObj=new Login();




switch($status){ 
    
        case "load_functions":
         
        $role_id = $_POST["role"];
        
        $moduleResult=$userObj->getRoleModules($role_id);
        
        while ($module_row=$moduleResult->fetch_assoc())
        {
            $module_id = $module_row["module_id"];
            $functionResult = $userObj->getModuleFunctions($module_id);
            ?>
                <div class="col-md-4">
                    <h4>
                        <?php
                            echo $module_row["module_name"];
                            echo "</br>";
                        ?>
                    </h4>
                        <?php
                            while($fun_row=$functionResult->fetch_assoc()){
                                ?>
                    <input type="checkbox" name="fun[]" value="<?php echo $fun_row["function_id"];?>" checked/>
                                <?php echo $fun_row["function_name"];?>
                                <br/>
                                <?php
                            }
                        ?>
                </div>
            <?php
        }
        
    break;    
     
case "add_user":
        
$fname  =$_POST["fname"];
$lname =$_POST["lname"];
$dob =$_POST["dob"];
$email =$_POST["email"];
$nic =$_POST["nic"];
$cno  =$_POST["cno"];
$address  =$_POST["address"];
$user_role = $_POST["user_role"];
$user_image=$_FILES["user_image"];
$user_functions=$_POST["fun"];


try{
    if($fname=="")
    {
        
        throw new Exception("First Name cannot be Empty!!!!");
    }
    
            ///image upload
    $file_name="";
            if(isset($_FILES["user_image"]))
            {
                if ($user_image["name"] !=""){
       
                    $file_name=time()."_".$_FILES["user_image"]["name"];
                    $path="../images/user_images/$file_name";
                    move_uploaded_file($user_image["tmp_name"], $path);
                    
                    
                }
                
            }
            $user_id=$userObj->addUser($fname, $lname, $dob, $email,$nic,$address, $user_role, $file_name );
          
            
            //creating login account
            if($user_id>0)
            {
                
               $loginObj->addUserLogin($user_id, $email, $nic);
               
               
            // add user contacts
            $userObj->addUserContact($user_id,$cno);

                    //add user functions
            foreach($user_functions as $fun_id){
                $userObj->addUserFunctions($user_id,$fun_id);
            }
            
            $msg="User $fname $lname Succesfully Added!";
            $msg= base64_encode($msg);
     
     
     ?>
    
     <script>
        window.location="../view/view-users.php?msg=<?php echo $msg;  ?>";
    </script>
    
    <?php
         
         
     }

        
}
        
 catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-user.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }

            break;
    
        case "activate":
            $user_id = $_GET["user_id"];
            $user_id = base64_decode($user_id);
            $userObj->activateUser($user_id);
            $msg = "Successfully Activated!!!";
            $msg = base64_encode($msg);
            ?>
            <script>
            window.location="../view/view-users.php?msg=<?php echo $msg; ?>";
            </script>
        <?php
        break;

        case "deactivate":
            $user_id = $_GET["user_id"];
            $user_id = base64_decode($user_id);
            $userObj->deactivateUser($user_id);
            $msg = "Successfully Deactivated!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-users.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
        
        
       case "delete":
            $user_id = $_GET["user_id"];
            $user_id = base64_decode($user_id);
            $userObj->deleteUser($user_id);
            //delete existing contact
                $userObj->removeUserContacts($user_id);
                //delete existing functions
            $userObj->removeUserFunctions($user_id);    
                
            $msg = "Successfully Deleted!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-users.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
        
        
        case "update_user":
            
            $user_id=$_POST["user_id"];
            
            $fname  =$_POST["fname"];
            $lname =$_POST["lname"];
            $dob =$_POST["dob"];
            $email =$_POST["email"];
            $nic =$_POST["nic"];
            $cno  =$_POST["cno"];
            $address  =$_POST["address"];
            $user_role = $_POST["user_role"];
            $user_image=$_FILES["user_image"];
           
            if(isset($_POST["fun"]))
            {
               $user_functions=$_POST["fun"]; 
            }
            
            try{
                
                $userResult=$userObj->getUser($user_id);
                $userrow=$userResult->fetch_assoc();
                $prev_image=$userrow["user_image"];
                
                if(isset($_FILES["user_image"]))
                {
                    
                    if($_FILES["user_image"]["name"]!="")
                    {
                        //upload new image
                        
                        $img=time()."_".$_FILES["user_image"]["name"];
                        $path="../images/user_images/";
                        move_uploaded_file($_FILES["user_image"]["tmp_name"], $path."$img");
                        
                        //remove prev image
                        if(file_exists($path.$prev_image)&& $prev_image!="")
                        {
                            unlink($path.$prev_image);
                        }
                        
                    }
                    else
                    {
                        $img=$prev_image;
                    }
                }
                
                //update user
                $userObj->UpdateUser($fname,$lname,$dob,$email,$nic,$address,$user_role,$img,$user_id);
                
                //delete existing contact
                $userObj->removeUserContacts($user_id);
                
                //insert new contact
                $userObj->addUserContact($user_id,$cno);
                
                //delete existing functions
                $userObj->removeUserFunctions($user_id);
                
                //addding updated fucntions
                
                foreach ($user_functions as $f) {
                    $userObj->addUserFunctions($user_id,$f);
                }
                
                $msg="Successfully updated!";
                $msg= base64_encode($msg);
                ?>
                        
                        <script>
                            window.location="../view/view-users.php?msg=<?php echo $msg; ?>";
                        </script>
                        <?php
                        


            }
                
               
                
             catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/edit-user.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
            }
                             break;        

            
            
          
        
        
            
            
           
        
        
}
  
            



 
 
 
 
