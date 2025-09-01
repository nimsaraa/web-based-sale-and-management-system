<?php
include_once '../commons/session.php';
include_once '../Model/purchase_model.php';
include_once '../Model/user_model.php';

$purchaseObj = new Purchase();
$poList = $purchaseObj->getAllPO(); 
$userrow = $_SESSION["user"];
?>

<html>
    <head>
        <?php include_once '../includes/bootstrap_css_includes.php'; ?>
        
    </head>
    <body>
        <div class="container">
    <?php
            $pageName = "ADD GRN";
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
                                <a href="view-grns.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-grn.php">
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
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>

                </div>
            </div>

            <form action="../controller/purchase_controller.php?status=add_grn" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <label>Purchase Order</label>
                        <select name="po_id" class="form-control" onchange="loadPOItems(this.value)" required>
                            <option value="">Select PO</option>
                            <?php while ($po = $poList->fetch_assoc()) { ?>
                                <option value="<?php echo $po['po_id'] ?>">PO #<?php echo $po['po_id'] ?> - <?php echo $po['po_date'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    

                    <div class="col-md-4">
                        <label>Received By</label>
                        <input type="hidden" name="user_id" value="<?php echo $userrow["user_id"] ?>">
                        <input type="text" class="form-control" value="<?php echo $userrow["user_fname"] . ' ' . $userrow["user_lname"] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>GRN Date</label>
                        <input type="date" name="grn_date" class="form-control" min="<?php echo date("Y-m-d") ?>" required>
                    </div>
                </div>
                

                <hr>
                <div id="poItemsContainer">
                    
                </div>

                <div class="row">

                        <div class="col-md-offset-3 col-md-6">
                            <input type="submit" class="btn btn-primary" value="Submit"/>
                            <input type="reset" class="btn btn-danger" value="Reset"/>
                        </div>
                    </div>
            </form>

            
            
        </div>

    
    
   
    
</div>
</body>
<script>
            function loadPOItems(poId) {
                if (poId === '') return;

                
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "../controller/purchase_controller.php?status=get_po_items&po_id=" + poId, true);
                xhr.onload = function () {
                    document.getElementById("poItemsContainer").innerHTML = this.responseText;
                };
                xhr.send();
            }
        </script>
</html>
