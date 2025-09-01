$(document).ready(function(){
    
   
   
    
    $("form").submit(function(){
        
        var pname= $("#pname").val();
        var description= $("#pdescription").val();
        var price= $("#price").val();
        
        
        var image1=$("#product_image1").val();
        var image2=$("#product_image1").val();
        var image3=$("#product_image1").val();
        
        var imageTitle1= $("#Image_title1").val();
        var imageTitle2= $("#Image_title2").val();
        var imageTitle3= $("#Image_title3").val();
        
        var qtyInput = $(this).find("input[name='qty']");
        var qtyVal = qtyInput.val();
        
        
        
        
        if(pname=="")
        {
            $("#msg").html("Product Name Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(description=="")
        {
            $("#msg").html("Description Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if(price=="")
        {
            $("#msg").html("Price Cannot Be Empty!");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
         if(parseFloat(price) <= 0) {
            $("#msg").html("Price must be greater than zero.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        if (imageTitle1 !== "" && image1 === "") {
            $("#msg").html("You cannot enter Image Title 1 without selecting Image 1.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (imageTitle2 !== "" && image2 === "") {
            $("#msg").html("You cannot enter Image Title 2 without selecting Image 2.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (imageTitle3 !== "" && image3 === "") {
            $("#msg").html("You cannot enter Image Title 3 without selecting Image 3.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
        if ($("input[name='size[]']:checked").length === 0) {
            $("#msg").html("Please select at least one size.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

      
        if ($("input[name='colour[]']:checked").length === 0) {
            $("#msg").html("Please select at least one colour.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }
        
      

        
        
        
        
    });
    
    
    
});