<?php

include_once '../commons/session.php';
include_once '../Model/customer_model.php';
include_once '../Model/order_model.php';
include_once '../Model/product_model.php';

$userrow = $_SESSION["user"];
$customerObj= new Customer();
$orderobj= new Order();
$productObj= new Product();

$payResult=$orderobj->getAllPayements();
$productResult=$productObj->getAllProducts();
$sizeResult=$productObj->getAllSizes();
$colourResult=$productObj->getAllColours();
$customerResult=$customerObj->getAllCustomers();

$order_id= base64_decode($_GET["order_id"]);
$orderResult=$orderobj->getorder($order_id);
$orderItemResult=$orderobj->getorderItems($order_id);
$orderrow=$orderResult->fetch_assoc();


$sizeList = [];
while ($row = $sizeResult->fetch_assoc()) {
    $sizeList[] = $row;
}

$colourList = [];
while ($row = $colourResult->fetch_assoc()) {
    $colourList[] = $row;
}


        
?>

<html>
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            $pageName = "EDIT ORDER";
            ?>
            <?php
            include_once '../includes/header_row_includes.php';
            ?>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>
            <div style="height: 50px" align="center">
                <div class="col-md-12">
                   
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-orders.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-order.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add order
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="order-reports.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    Reports
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <form action="../Controller/order_controller.php?status=edit_order" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3" id="msg">
                            </div>
                            <?php
                            if (isset($_GET["msg"])) {
                                ?>
                                <div class="col-md-6 col-md-offset-3 alert alert-danger" >
                                    <?php echo base64_decode($_GET["msg"]); ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-md-2">
                                <label class="control-label">customer name</label>
                            </div>
                            <div class="col-md-4">
                                <select name="cus_id" id="cus_id" class="form-control" >
                                    <option value="">---------</option>
                                    <?php
                                    while ($customerrow = $customerResult->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $customerrow["cus_id"]; ?>"
                                                
                                                <?php
                                                    if ($customerrow["cus_id"] == $orderrow["cus_id"]) {
                                                        ?>
                                                        selected
                                                        <?php
                                                    }
                                                    ?>

                                                >
                                         Id <?php echo $customerrow["cus_id"]?> :  <?php echo $customerrow["cus_fname"]." ".$customerrow["cus_lname"]; ?> 
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">order date</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="ordate" id="ordate" value="<?php echo $orderrow["order_date"] ?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Payement type</label>
                            </div>
                            <div class="col-md-4">
                                <select name="payement" id="payement" class="form-control" >
                                    <option value="">---------</option>
                                    <?php
                                    while ($payrow = $payResult->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $payrow["pay_type_id"]; ?>"
                                                
                                                <?php
                                                    if ($payrow["pay_type_id"] == $orderrow["payement"]) {
                                                        ?>
                                                        selected
                                                        <?php
                                                    }
                                                    ?>
                                                
                                                >
                                            <?php echo $payrow["payment_type"]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Total Amount (RS)</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="total" id="total" value="<?php echo $orderrow["total"] ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="productItemsTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Product</th>
                                                <th>Size</th>
                                                <th>Colour</th>
                                                <th>Unit Price (RS)</th>
                                                <th>Quantity</th>
                                                <th>Total Price (RS)</th>
                                                <th><button type="button" class="btn btn-success" onclick="addRow()">add</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($orderItemrow = $orderItemResult->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                    <td>
                                                        <select name="product[]" class="form-control sku-select" >
                                                            <option value="">---------</option>
                                                            <?php
                                                            // Reset result pointer since it's reused in a loop
                                                            $productResult->data_seek(0);
                                                            while ($productrow = $productResult->fetch_assoc()) {
                                                                ?>
                                                                <option 
                                                                    value="<?php echo $productrow["product_id"]; ?>" 
                                                                    data-price="<?php echo $productrow["price"]; ?>"


                                                                    <?php
                                                                    if ($productrow["product_id"] == $orderItemrow["product_id"]) {
                                                                        ?>
                                                                        selected
                                                                        <?php
                                                                    }
                                                                    ?>


                                                                    >
                                                                        <?php echo $productrow["product_name"]; ?>
                                                                </option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                    </td>
                                                    <td>

                                                        <select name="size[]" class="form-control" >
                                                            <option value="">---------</option>
                                                            <?php foreach ($sizeList as $sizerow) { ?>
                                                                <option value="<?php echo $sizerow["size_id"]; ?>"
                                                                        
                                                                        <?php
                                                                    if ($sizerow["size_id"] == $orderItemrow["size_id"]) {
                                                                        ?>
                                                                        selected
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                        
                                                                        >
                                                                    <?php echo $sizerow["size"]; ?>
                                                                </option>
                                                            <?php } ?>
                                                    </select>
                                                </td>

                                                
                                                <td>
                                                    <select name="colour[]" class="form-control" >
                                                        <option value="">---------</option>
                                                        <?php foreach ($colourList as $colourrow) { ?>
                                                            <option value="<?php echo $colourrow["colour_id"]; ?>"
                                                                    <?php
                                                                    if ($colourrow["colour_id"] == $orderItemrow["colour_id"]) {
                                                                        ?>
                                                                        selected
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    >
                                                                <?php echo $colourrow["colour"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control" name="unit_price[]" step="0.01" oninput="calculateTotal(this)" value="<?php echo $orderItemrow['unit_price']; ?>" >
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control" name="quantity[]" oninput="calculateTotal(this)" value="<?php echo $orderItemrow['quantity']; ?>" >
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control" name="total_price[]" value="<?php echo $orderItemrow['total_price']; ?>" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" onclick="removeRow(this)" >remove</button>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-offset-3 col-md-6">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="btn btn-danger" value="Reset"/>
                                </div>
                            </div>


                    </div>
                    </form>
                   
                </div>
            </div>
            
            
        </div>
    </body>
    <script>
    function addRow() {
    const table = document.getElementById("productItemsTable").getElementsByTagName('tbody')[0];
    const newRow = table.rows[0].cloneNode(true);

    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

    table.appendChild(newRow);
    
}


    function removeRow(button) {
        const row = button.closest('tr');
        const table = document.getElementById("productItemsTable").getElementsByTagName('tbody')[0];
        if (table.rows.length > 1) {
            row.remove();
        }
    }

    function calculateTotal(input) {
    const row = input.closest('tr');

    const unitInput = row.querySelector('[name="unit_price[]"]');
    const qtyInput = row.querySelector('[name="quantity[]"]');
    let unitPrice = parseFloat(unitInput.value) || 0;
    let quantity = parseFloat(qtyInput.value) || 0;

    

    const total = unitPrice * quantity;
    row.querySelector('[name="total_price[]"]').value = total.toFixed(2);

    calculatePOTotal(); 
}

    function calculatePOTotal() {
    let total = 0;
    document.querySelectorAll('[name="total_price[]"]').forEach(input => {
        total += parseFloat(input.value) || 0;
    });
    document.getElementById('total').value = total.toFixed(2);
}

    </script>
    <script>
   
    document.addEventListener('change', function (e) {
        if (e.target && e.target.matches('.sku-select')) {
            const selectedOption = e.target.selectedOptions[0];
            const unitPrice = selectedOption.getAttribute('data-price');

            const row = e.target.closest('tr');
            const unitInput = row.querySelector('[name="unit_price[]"]');

            if (unitInput && unitPrice) {
                unitInput.value = parseFloat(unitPrice).toFixed(2);
                calculateTotal(unitInput);
            }
        }
    });
</script>

    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/ordervalidation.js"></script>

</html>