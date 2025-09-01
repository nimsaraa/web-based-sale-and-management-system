$(document).ready(function () {
    
    $("form").submit(function () {   
        
        var vno= $("#vno").val();
        var vtype= $("#vtype").val();
        
        if(vno=="")
        {
            $("#msg").html("Vehicle number Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(vtype=="")
        {
            $("#msg").html("Veicle type Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        var patVehicle = /^[A-Z]{2,3}-\d{4}$/;

        
       
        if(!vno.match(patVehicle))
        {   
            $("#msg").html("vehicle number is invalid!");
            $("#msg").addClass("alert alert-danger");
            return false;
            
        }
        
        
    });
});
