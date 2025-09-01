<?php

include '../commons/session.php';
include '../Model/inventory_model.php';

$status = $_GET["status"];
$stockobj = new stock();

switch($status){

    case "add_product_stock":
        $sku_id = $_POST["sku_id"];
        $qty = $_POST["qty"];
        $pro_id = $_POST["pro_id"];
        $relevel = $_POST["relevel"];

        try {
            if ($qty === "") {
                        ?>
                <script>
                 alert("Quantity cannot be empty!");
                 window.history.back();
                </script>
                <?php
                exit();
            }

            if ($qty <= 0) {
                ?>
                <script>
                 alert("Quantity must be a positive number!");
                window.history.back();
                </script>
                <?php
                exit();
            }
            
            if ($relevel < 0) {
                ?>
                <script>
                 alert("reorder level must be a positive number!");
                window.history.back();
                </script>
                <?php
                exit();
            }


            $stock_id = $stockobj->addStock($sku_id, $qty, $pro_id, $relevel);

            $msg = "Stock for SKU: $sku_id successfully added!";
            $msg = base64_encode($msg);

        } catch (Exception $ex) {
            $msg = base64_encode($ex->getMessage());
        }
        ?>
        <script>
            window.location = "../view/view-products-stock.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;

    case "add_raw":
        $raw_name = $_POST["rname"];
        $supplier_id = $_POST["supplier_name"];

        try {
            if ($raw_name == "") {
                throw new Exception("Raw Name cannot be empty!");
            }

            $raw_id = $stockobj->addRaw($raw_name, $supplier_id);
            $msg = base64_encode("Raw $raw_name successfully added!");

            ?>
            <script>
                window.location = "../view/view-raw.php?msg=<?php echo $msg; ?>";
            </script>
            <?php

        } catch (Exception $ex) {
            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/add-raw.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;

    case "delete":
        $raw_id = base64_decode($_GET["raw_id"]);
        $stockobj->deleteRaw($raw_id);

        $msg = base64_encode("Successfully Deleted!");
        ?>
        <script>
            window.location = "../view/view-raw.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;

    case "edit_raw":
        $raw_id = $_POST["raw_id"];
        $raw_name = $_POST["rname"];
        $supplier_id = $_POST["supplier_name"];

        try {
            $stockobj->UpdateRaw($raw_id, $raw_name, $supplier_id);
            $msg = base64_encode("Raw $raw_name successfully updated!");
            ?>
            <script>
                window.location = "../view/view-raw.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } catch (Exception $ex) {
            $msg = base64_encode($ex->getMessage());
            ?>
            <script>
                window.location = "../view/edit-raw.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        }
        break;

    case "add_raw_stock":
        $raw_id = $_POST["raw_id"];
        $qty = $_POST["qty"];
        $unit = $_POST["unit"];
        $relevel = $_POST["relevel"];

        try {
            if ($qty === "") {
                        ?>
                <script>
                 alert("Quantity cannot be empty!");
                 window.history.back();
                </script>
                <?php
                exit();
            }

            if ($qty <= 0) {
                ?>
                <script>
                 alert("Quantity must be a positive number!");
                window.history.back();
                </script>
                <?php
                exit();
            }
            
            if ($relevel < 0) {
                ?>
                <script>
                 alert("reorder level must be a positive number!");
                window.history.back();
                </script>
                <?php
                exit();
            }

            $stock_id = $stockobj->addRawStock($raw_id, $qty, $unit, $relevel);

            $msg = base64_encode("Stock for Raw No: $raw_id successfully added!");

        } catch (Exception $ex) {
            $msg = base64_encode($ex->getMessage());
        }
        ?>
        <script>
            window.location = "../view/view-raw-stock.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;

    case "clear":
        $sku_id = base64_decode($_GET["sku_id"]);
        $stockobj->clearStock($sku_id);

        $msg = base64_encode("Successfully Deleted!");
        ?>
        <script>
            window.location = "../view/view-products-stock.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;
    
     case "clear_raw":
        $raw_id = base64_decode($_GET["raw_id"]);
        $stockobj->clearRaw($raw_id);

        $msg = base64_encode("Successfully Cleared!");
        ?>
        <script>
            window.location = "../view/view-raw-stock.php?msg=<?php echo $msg; ?>";
        </script>
        <?php
        break;
}
?>
