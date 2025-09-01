$(document).ready(function(){
    
    
   $("#user_role").change(function(){
        
        var role_id=$("#user_role").val();
        var url ="../controller/user_controller.php?status=load_functions";
        
        $.post(url,{role:role_id},function(data){
            $("#display_functions").html(data).show();
        });
        
    });
    
    $("form").submit(function(){
        
        var fname= $("#fname").val();
        var lname= $("#lname").val();
        var dob= $("#dob").val();
        var email= $("#email").val();
        var nic= $("#nic").val();
        var cno= $("#cno").val();
        var address= $("#address").val();
        
        if(fname=="")
        {
            $("#msg").html("First Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(lname=="")
        {
            $("#msg").html("Last Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(dob=="")
        {
            $("#msg").html("Date of birth Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(email=="")
        {
            $("#msg").html("Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(nic=="")
        {
            $("#msg").html("NIC Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(cno=="")
        {
            $("#msg").html("Contact No Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(address=="")
        {
            $("#msg").html("Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        
        var patNic  = /^([0-9]{9}[vVxX]|[0-9]{12})$/;
        var patmobile = /^0[0-9]{9}$/;

        
        if(!nic.match(patNic))
        {
            $("#msg").html("NIC is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
        if(!cno.match(patmobile))
        {   
            $("#msg").html("Mobile Number is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
       
       
        
        
        
        
    });
    
    
    
});