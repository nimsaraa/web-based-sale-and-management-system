<?php

include_once '../commons/session.php';
include_once '../Model/supplier_model.php';
include_once '../Model/user_model.php';
include_once '../Model/inventory_model.php';
include_once '../Model/purchase_model.php';

$userrow = $_SESSION["user"];
$supObj=new Supplier();
$stockObj= new Stock();
$purchaseObj=new Purchase();

$supResult=$supObj->getAllSuppliers();
$stockResult=$stockObj->getAllRaw();
$unitResult=$stockObj->getAllUnits();

$po_id= base64_decode($_GET["po_id"]);
$purchaseresult=$purchaseObj->getpo($po_id);
$poItemresult=$purchaseObj->getpoItems($po_id);
$purchaserow=$purchaseresult->fetch_assoc();

// Fetch all stock rows into array for reuse in selects
$stockArr = [];
while ($row = $stockResult->fetch_assoc()) {
    $stockArr[] = $row;
}

// Fetch all unit rows into array for reuse in selects
$unitArr = [];
while ($row = $unitResult->fetch_assoc()) {
    $unitArr[] = $row;
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
            $pageName = "EDIT PURCHASE ORDER";
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
                   
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-po.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View purchase orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-po.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add PO
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="purchasing.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="purchasing.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="grn-report.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Purchase Reports
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                </div>
                <form action="../Controller/purchase_controller.php?status=edit_po" method="post" >
                    <input type="hidden" name="po_id" value="<?php echo $po_id; ?>">

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
                                <label class="control-label">Supplier name</label>
                            </div>
                            <div class="col-md-4">
                                <select name="sup_id" id="sup_id" class="form-control" >
                                    <option value="">---------</option>
                                    <?php
                                    while ($supRow = $supResult->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $supRow["sup_id"]; ?>"
                                                
                                                <?php
                                                    if ($supRow["sup_id"] == $purchaserow["sup_id"]) {
                                                        ?>
                                                        selected
                                                        <?php
                                                    }
                                                    ?>



                                                >
                                            <?php echo $supRow["Supplier_name"]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="control-label">User Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="user_id" value="<?php echo $userrow['user_id']; ?>" />
                                <input type="text" class="form-control" name="uname" id="uname" value="<?php echo $userrow["user_fname"] . " " . $userrow["user_lname"]; ?>"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Purchase order date</label>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control" name="podate" id="podate" value="<?php  echo $purchaserow["po_date"] ?>"/>
                            </div>
                            <div class="col-md-2">
                                <label class="control-label">Po Total Amount (RS)</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="po_total" id="po_total" value="<?php  echo $purchaserow["po_total"]?>" />
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
                                    <table class="table table-bordered table-hover" id="rawItemsTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Raw Name</th>
                                                <th>Unit Price (RS)</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Total Price (RS)</th>
                                                <th><button type="button" class="btn btn-success" onclick="addRow()">add</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($poItemrow = $poItemresult->fetch_assoc()) { 
                                            ?>
                                            <tr>
                                                <td>
                                                    <select name="raw_id[]" class="form-control" required>
                                                        <option value="">---------</option>
                                                        <?php foreach ($stockArr as $rawRow) { 
                                                            ?>
                                                            <option value="<?php echo $rawRow["raw_id"]; ?>"
                                                                <?php echo ($rawRow["raw_id"] == $poItemrow["raw_id"]) ? "selected" : "" ?>
                                                                    >
                                                                <?php echo $rawRow["raw_name"]; ?>
                                                            </option>
                                                        <?php
                                                        } 
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="unit_price[]" step="0.01" oninput="calculateTotal(this)" value="<?php echo $poItemrow['unit_price']; ?>" required>
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control" name="quantity[]" oninput="calculateTotal(this)"  value="<?php echo $poItemrow['qty']; ?>" required>
                                                </td>
                                                <td>
                                                     <select name="unit[]" class="form-control" required>
                                                        <option value="">---------</option>
                                                        <?php foreach ($unitArr as $unitRow) { ?>
                                                            <option value="<?php echo $unitRow["unit_id"]; ?>"
                                                                <?php echo ($unitRow["unit_id"] == $poItemrow["unit_id"]) ? "selected" : "" ?>>
                                                                <?php  echo $unitRow["unit_name"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="total_price[]"  value="<?php echo $poItemrow['total_price']; ?>"readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" onclick="removeRow(this)" >remove</button>
                                                </td>
                                                <input type="hidden" name="po_item_id[]" value="<?php echo $poItemrow['po_item_id']; ?>">
                                            </tr>
                                            
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
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


            </div>

            </form>
            </div>
        </div>
    </body>
    <script>
    function addRow() {
    const table = document.getElementById("rawItemsTable").getElementsByTagName('tbody')[0];
    const newRow = table.rows[0].cloneNode(true);

    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

    table.appendChild(newRow);
    
}


    function removeRow(button) {
        const row = button.closest('tr');
        const table = document.getElementById("rawItemsTable").getElementsByTagName('tbody')[0];
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
    document.getElementById('po_total').value = total.toFixed(2);
}

    </script>
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/purchasevalidation.js"></script>


</html>