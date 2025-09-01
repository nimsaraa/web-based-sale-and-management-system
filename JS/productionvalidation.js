$(document).ready(function () {


    $("form").submit(function () {
        var sku_id = $("#sku_id").val();
        var pdate = $("#pdate").val();
        var pqty = $("#pqty").val();
        var today = new Date().toISOString().split("T")[0];

        // Clear previous message
        $("#msg").removeClass().html("");

        if (sku_id == "") {
            $("#msg").html("Please select a SKU.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        

        if (pdate == "") {
            $("#msg").html("Please select a production date.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (pdate > today) {
            $("#msg").html("Production date cannot be in the future.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (pqty == "") {
            $("#msg").html("Quantity cannot be empty.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        if (pqty <= 0) {
            $("#msg").html("Quantity must be a positive number.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

       
    });

});

