$(document).ready(function () {

    $("form").submit(function () {

        var supplier = $("#sup_id").val();
        var podate = $("#podate").val();
        var po_total = $("#po_total").val().trim();

       
        

        // Supplier validation
        if (supplier === "") {
            $("#msg").html("Please select a supplier.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        // Date validation
        if (podate === "") {
            $("#msg").html("Please select the purchase order date.");
            $("#msg").addClass("alert alert-danger");
            return false;
        }

        
        // Table row validations
        var rows = $("#rawItemsTable tbody tr");
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];

            var raw = $(row).find('select[name="raw_id[]"]').val();
            var unit_price = $(row).find('input[name="unit_price[]"]').val().trim();
            var quantity = $(row).find('input[name="quantity[]"]').val().trim();
            var unit = $(row).find('select[name="unit[]"]').val();

            if (raw === "") {
                $("#msg").html("Please select a raw material for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (unit_price === ""  || parseFloat(unit_price) <= 0) {
                $("#msg").html("Unit price must be a valid positive number for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (quantity === ""  || parseFloat(quantity) <= 0) {
                $("#msg").html("Quantity must be a valid positive number for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }

            if (unit === "") {
                $("#msg").html("Please select a unit for item " + (i + 1));
                $("#msg").addClass("alert alert-danger");
                return false;
            }
        }

       
    });

});
