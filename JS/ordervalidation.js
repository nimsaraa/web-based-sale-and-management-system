$(document).ready(function () {
    
    $("form").submit(function () {
        var customer = $("#cus_id").val();
        var orderDate = $("#ordate").val();
        var payment = $("#payement").val();
        var total = $("#total").val().trim();

      

        // Customer validation
        if (customer === "") {
            $("#msg").html("Please select a customer.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Date validation
        if (orderDate === "") {
            $("#msg").html("Please select the order date.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Payment type validation
        if (payment === "") {
            $("#msg").html("Please select a payment type.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Total validation
        if (total === "" || isNaN(total) || parseFloat(total) <= 0) {
            $("#msg").html("Total amount must be a valid positive number.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Product table row validation
        var rows = $("#productItemsTable tbody tr");
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];

            var product = $(row).find('select[name="product[]"]').val();
            var size = $(row).find('select[name="size[]"]').val();
            var colour = $(row).find('select[name="colour[]"]').val();
            var unit_price = $(row).find('input[name="unit_price[]"]').val().trim();
            var quantity = $(row).find('input[name="quantity[]"]').val().trim();

            if (product === "") {
                $("#msg").html("Please select a product for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (size === "") {
                $("#msg").html("Please select a size for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (colour === "") {
                $("#msg").html("Please select a colour for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (unit_price === "" || parseFloat(unit_price) <= 0) {
                $("#msg").html("Unit price must be a valid positive number for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (quantity === ""  || parseFloat(quantity) <= 0) {
                $("#msg").html("Quantity must be a valid positive number for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }
        }

        
    });
});
