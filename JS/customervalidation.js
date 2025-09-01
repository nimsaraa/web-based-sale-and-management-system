$(document).ready(function(){
    
     $("form").submit(function(){
        
        var fname= $("#fname").val();
        var lname= $("#lname").val();
        
        var email= $("#email").val();
        
        var cno1= $("#cno1").val();
        var cno2= $("#cno2").val();
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
        
        if(email=="")
        {
            $("#msg").html("Email Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(address=="")
        {
            $("#msg").html("Address Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
      
        if(cno1=="")
        {
            $("#msg").html("Contact No01 Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(cno2=="")
        {
            $("#msg").html("Contact No 02 Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        
        
        var patmobile = /^0[0-9]{9}$/;
        
       
        if(!cno1.match(patmobile))
        {   
            $("#msg").html("Mobile Number is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
        if(!cno2.match(patmobile))
        {   
            $("#msg").html("Mobile Number is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
       
       
        
        
        
        
    });
    
    
});