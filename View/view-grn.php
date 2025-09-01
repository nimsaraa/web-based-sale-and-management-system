<?php
include_once '../commons/session.php';
include_once '../Model/purchase_model.php';
include_once '../Model/user_model.php';

$purchaseObj = new Purchase();
$poList = $purchaseObj->getAllPO(); 
$userrow = $_SESSION["user"];

$grn_id= base64_decode($_GET["grn_id"]);
$purchaseresult=$purchaseObj->getGrn($grn_id);
$purchaserow=$purchaseresult->fetch_assoc();
?>

<html>
    <head>
        <?php include_once '../includes/bootstrap_css_includes.php'; ?>
        
    </head>
    <body>
        <div class="container">
    <?php
            $pageName = "VIEW GRN";
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

            <form action="../controller/purchase_controller.php?status=edit_grn" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <label>Purchase Order</label>
                        <input type="text" class="form-control"  value="PO #<?php echo $purchaserow['po_id']; ?> - <?php echo $purchaserow['po_date']; ?>" readonly>
                        

                    </div>

                    

                    <div class="col-md-4">
                        <label>Received By</label>
                        
                        <input  class="form-control" value="<?php echo $userrow["user_fname"] . ' ' . $userrow["user_lname"] ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>GRN Date</label>
                        <input  name="grn_date" class="form-control" value="<?php echo $purchaserow["grn_date"]; ?>" readonly>
                    </div>
                </div>
                

                <hr>
                <div id="poItemsContainer">
                    <!-- Dynamically filled by AJAX -->
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
    function loadGRNItems(grnId) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "../controller/purchase_controller.php?status=get_grn_items_for_view&grn_id=" + grnId, true);
    xhr.onload = function () {
        document.getElementById("poItemsContainer").innerHTML = this.responseText;
    };
    xhr.send();
    }

    window.onload = function () {
    var grnId = "<?php echo $purchaserow['grn_id']; ?>";
    loadGRNItems(grnId);
    };
                </script>

</html>
