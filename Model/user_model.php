<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class User{
    
    public function getAllRoles(){
        
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM role";
        $result=$con->query($sql)or die($con->error);
        return $result;
    }
    
    public function getRoleModules($roleId) {
        
        $con=$GLOBALS["con"];
        $sql= "SELECT * FROM role_module r, module m WHERE r.module_id=m.module_id AND r.role_id='$roleId'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
        
    }
    
    public function getModuleFunctions($moduleId) {
        $con=$GLOBALS["con"];
        $sql= "SELECT * FROM  function WHERE module_id='$moduleId'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
        
        
    }
    
    public function addUser($fname,$lname,$dob,$email,$nic,$address,$user_role,$user_image) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO user(user_fname,user_lname,user_dob,user_email,user_nic,address,user_role,user_image)VALUES ('$fname','$lname','$dob','$email','$nic','$address','$user_role','$user_image')";
        $con->query($sql) or die ($con->error);
        $user_id=$con->insert_id;
        return $user_id;
        
    }
    
    public function addUserFunctions($user_id,$fun_id) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO function_user(function_id ,user_id) VALUES('$fun_id','$user_id')";
        $con->query($sql) or die($con->error);
    }
    public function addUserContact($user_id,$contact_no) {
        $con=$GLOBALS["con"];
        $sql="INSERT INTO user_contact(contact_number,user_id)VALUES ('$contact_no','$user_id')";
        $con->query($sql) or die ($con->error);
         
        
        
    }
    
    public function getAllUsers() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM user WHERE user_status !=-1";
        $result = $con->query($sql) or die ($con->error);
        return $result;
    
        
    }
    
    public function activateUser($user_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE user SET user_status='1' WHERE user_id='$user_id'";
        $result = $con->query($sql) or die ($con->error);

         }
         
    public function deactivateUser($user_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE user SET user_status='0' WHERE user_id='$user_id'";
        $result = $con->query($sql) or die ($con->error);

         } 
         
    public function deleteUser($user_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE user SET user_status='-1' WHERE user_id='$user_id'";
        $result = $con->query($sql) or die ($con->error);

         } 
         
    public function getUser($user_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM user u, role r WHERE u.user_role=r.role_id AND user_id='$user_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;
             
         }
         
    public function getUserFunctions($user_id) {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM Function_user WHERE user_id='$user_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;     
         }
    
    public function getUserContact($user_id) {
         $con=$GLOBALS["con"];
        $sql="SELECT * FROM user_contact WHERE user_id='$user_id'";
        $result = $con->query($sql) or die ($con->error);
        return $result;      
         } 
         
    public function UpdateUser($fname,$lname,$dob,$email,$nic,$address,$user_role,$user_image,$user_id) {
           $con=$GLOBALS["con"];
           $sql="UPDATE user SET  user_fname='$fname',"
                   . "user_lname='$lname',"
                   . "user_dob='$dob',"
                   . "user_email='$email',"
                   . "user_nic='$nic',"
                   . "address='$address',"
                   . "user_role='$user_role',"
                   . "user_image='$user_image' WHERE user_id='$user_id' ";
           $result=$con->query($sql)or die($con->error);
           return $result; 
             
         }
         public function removeUserContacts($user_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM user_contact WHERE user_id='$user_id'";
             $result=$con->query($sql)or die($con->error);
             return $result; 
             
         }
         
         public function removeUserFunctions($user_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM function_user WHERE user_id='$user_id'";
             $result=$con->query($sql)or die($con->error);
             return $result; 
         }
         
         public function getActivateUserCount() {
             $con=$GLOBALS["con"];
             $sql="SELECT COUNT(user_id) as user_count FROM user WHERE user_status=1;";
             $result = $con->query($sql) or die ($con->error);
             return $result; 
         }
         
         public function getDeActivateUserCount() {
             $con=$GLOBALS["con"];
             $sql="SELECT COUNT(user_id) as user_count FROM user WHERE user_status=0;";
             $result = $con->query($sql) or die ($con->error);
             return $result; 
         }
         
         
         
         
    
  
    
    
    
    
    
    
    
    
}