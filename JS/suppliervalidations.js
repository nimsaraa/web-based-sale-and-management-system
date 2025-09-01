$(document).ready(function(){
    



     $("form").submit(function(){
        
        var sname= $("#sname").val();
        var email= $("#email").val();
        var cno= $("#cno").val();
        var address= $("#address").val();
        var natno= $("#natno").val();
        
        if(sname=="")
        {
            $("#msg").html("Supplier Name Cannot Be Empty!");
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
      
        if(cno=="")
        {
            $("#msg").html("Contact No Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(natno=="")
        {
            $("#msg").html("NAT No Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        
        
        var patmobile = /^0[0-9]{9}$/;
        var patnatnumber=/^(\d{9}[VX]|^\d{10})$/;
       
        if(!cno.match(patmobile))
        {   
            $("#msg").html("Mobile Number is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
        
        if(!natno.match(patnatnumber))
        {   
            $("#msg").html("NAT Number is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
        

        
       
       
        
        
        
        
    });
    
    
});
