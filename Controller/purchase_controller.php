<?php
include '../commons/session.php';

$status = $_GET["status"];

include '../Model/purchase_model.php';

$purchaseObj = new Purchase();

switch ($status) {
    case "add_po":
        $sup_id      = $_POST["sup_id"];
        $user_id     = $_POST["user_id"];
        $po_date     = $_POST["podate"];
        $po_total    = $_POST["po_total"];

        $raw_ids      = $_POST["raw_id"];
        $unit_prices  = $_POST["unit_price"];
        $quantities   = $_POST["quantity"];
        $unit_ids     = $_POST["unit"];
        $total_prices = $_POST["total_price"];

        try {
            $po_id = $purchaseObj->addPurchaseOrder($sup_id, $user_id, $po_date, $po_total);

            for ($i = 0; $i < count($raw_ids); $i++) {
                $purchaseObj->addPurchaseOrderItem(
                    $po_id,
                    $raw_ids[$i],
                    $unit_prices[$i],
                    $quantities[$i],
                    $unit_ids[$i],
                    $total_prices[$i]
                );
            }

            $msg = "Successfully added!";
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/view-po.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } 
        catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-po.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
        }

            break;
            
            case "delete":
            $po_id = $_GET["po_id"];
            $po_id = base64_decode($po_id);
            $purchaseObj->deletePo($po_id);
            $purchaseObj->deletePOItems($po_id);
            
                
                
            $msg = "Successfully Deleted!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-po.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
        
        
       case "edit_po":
    $sup_id      = $_POST["sup_id"];
    $user_id     = $_POST["user_id"];
    $po_date     = $_POST["podate"];
    $po_total    = $_POST["po_total"];
    $po_id       = $_POST["po_id"];

    $raw_ids      = $_POST["raw_id"];
    $unit_prices  = $_POST["unit_price"];
    $quantities   = $_POST["quantity"];
    $unit_ids     = $_POST["unit"];
    $total_prices = $_POST["total_price"];
    $po_item_ids  = $_POST["po_item_id"];

    try {
        
        
       
        $purchaseObj->UpdatePurchaseOrder($sup_id, $user_id, $po_date, $po_total, $po_id);
        $purchaseObj->deletePoItems($po_id);

        for ($i = 0; $i < count($raw_ids); $i++) {
            $purchaseObj->addPurchaseOrderItem(
                $po_id,
                $raw_ids[$i],
                $unit_prices[$i],
                $quantities[$i],
                $unit_ids[$i],
                $total_prices[$i]
            );
        }

        $msg = "Successfully updated!";
        $msg = base64_encode($msg);
        ?>
         <script>
             window.location = '../view/view-po.php?msg=<?php echo $msg; ?>';
                      </script>
         <?php
    } catch (Exception $ex) {
        $msg = base64_encode($ex->getMessage());
?>
        <script>window.location='../view/edit-po.php?msg=<?php echo $msg; ?>'
        </script>
        <?php
    }
    break;
    
    
    case "add_grn":
                $po_id = $_POST["po_id"];
                $user_id = $_POST["user_id"];
                $grn_date = $_POST["grn_date"];

                $raw_ids = $_POST["raw_id"];
                $unit_ids = $_POST["unit_id"];
                $quantities = $_POST["received_qty"];
                

                try {
            $grn_id = $purchaseObj->addGRN($po_id, $user_id, $grn_date);

            for ($i = 0; $i < count($raw_ids); $i++) {
                $purchaseObj->addGRNItem(
                    $grn_id,
                    $raw_ids[$i],
                    $quantities[$i],
                    $unit_ids[$i]
                );

              
           

           $msg = "GRN Successfully added!";
            $msg = base64_encode($msg);
            ?>
            <script>window.location = '../view/view-grns.php?msg=<?php echo $msg; ?>';
            </script>
            <?php

        }
        }
        catch (Exception $ex) {
        $msg = base64_encode($ex->getMessage());
?>
        <script>window.location='../view/add-grn.php?msg=<?php echo $msg; ?>'
        </script>
        <?php
    }
        break;
        
        case "get_po_items":
        $po_id = $_GET["po_id"];
        $poItems = $purchaseObj->getpoItems($po_id);
        ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Raw Material</th>
                        <th>Ordered Qty</th>
                        <th>Unit</th>
                        <th>Received Qty</th>
                    </tr>
                </thead>
                <tbody>
        <?php while ($row = $poItems->fetch_assoc()) { ?>
                        <tr>
                            <td>
            <?php echo $row["raw_name"]; ?>
                                <input type="hidden" name="raw_id[]" value="<?php echo $row["raw_id"]; ?>">
                            </td>
                            <td><?php echo $row["qty"]; ?></td>
                            <td>
            <?php echo $row["unit_name"]; ?>
                                <input type="hidden" name="unit_id[]" value="<?php echo $row["unit_id"]; ?>">
                            </td>
                            <td>
                                <input type="number" name="received_qty[]" class="form-control" min="0" max="<?php echo $row["qty"]; ?>" step="0.01" required>
                            </td>
                        </tr>
        <?php } ?>
                </tbody>
            </table>
        <?php
        break;
        
         case "delete_grn":
            $grn_id = $_GET["grn_id"];
            $grn_id = base64_decode($grn_id);
            $purchaseObj->deleteGrn($grn_id);
            $purchaseObj->deleteGrnItems($grn_id);
            
                
                
            $msg = "Successfully Deleted!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-grns.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
        
        case "edit_grn":
        $grn_id = $_POST["grn_id"];
        $po_id = $_POST["po_id"];
        $user_id = $_POST["user_id"];
        $grn_date = $_POST["grn_date"];

        $raw_ids = $_POST["raw_id"];
        $unit_ids = $_POST["unit_id"];
        $quantities = $_POST["received_qty"];

        try {
            //  update GRN header 
            $purchaseObj->updateGRN($grn_id, $po_id, $user_id, $grn_date);

            // Delete existing GRN items
            $purchaseObj->deleteGrnItems($grn_id);

            //  Re-insert updated GRN items
            for ($i = 0; $i < count($raw_ids); $i++) {
                $purchaseObj->addGRNItem(
                        $grn_id,
                        $raw_ids[$i],
                        $quantities[$i],
                        $unit_ids[$i]
                );
            }

            $msg = base64_encode("GRN successfully updated!");
        ?>
                    <script>window.location = '../view/view-grns.php?msg=<?php echo $msg; ?>';</script>
            <?php
        } catch (Exception $ex) {
            $msg = base64_encode("Update failed: " . $ex->getMessage());
            ?>
                    <script>window.location = '../view/edit-grn.php?grn_id=<?php echo base64_encode($grn_id); ?>&msg=<?php echo $msg; ?>';</script>
            <?php
        }
        break;

    case "get_grn_items_for_edit":
        $grn_id = $_GET["grn_id"];

        $grnItems = $purchaseObj->getGrnItems($grn_id);
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Raw Material</th>
                        <th>Ordered Qty</th>
                        <th>Unit</th>
                        <th>Received Qty</th>
                    </tr>
                </thead>
                <tbody>
        <?php while ($row = $grnItems->fetch_assoc()) { ?>
                        <tr>
                            <td>
            <?php echo $row["raw_name"]; ?>
                                <input type="hidden" name="raw_id[]" value="<?php echo $row["raw_id"]; ?>">
                            </td>
                            <td><?php echo $row["ordered_qty"]; ?></td> <!-- Optional: from PO -->
                            <td>
            <?php echo $row["unit_name"]; ?>
                                <input type="hidden" name="unit_id[]" value="<?php echo $row["unit_id"]; ?>">
                            </td>
                            <td>
                                <input type="number" name="received_qty[]" class="form-control"
                                       min="0" max="<?php echo $row["ordered_qty"]; ?>" 
                                       value="<?php echo $row["received_qty"]; ?>" required>
                            </td>
                        </tr>
        <?php } ?>
                </tbody>
            </table>
        <?php
        break;

    case "get_grn_items_for_view":
    $grn_id = $_GET["grn_id"];

    $grnItems = $purchaseObj->getGrnItems($grn_id); 

    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Raw Material</th>
                <th>Ordered Qty</th>
                <th>Unit</th>
                <th>Received Qty</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $grnItems->fetch_assoc()) { ?>
            <tr>
                <td>
                    
                    <input class="form-control" value="<?php echo $row["raw_name"]; ?>" readonly>
                </td>
                <td>
                    <input class="form-control" value="<?php echo $row["ordered_qty"]; ?> " readonly>
                    
                <td>
                    
                    <input class="form-control" value="<?php echo $row["unit_name"]; ?>" readonly>
                </td>
                <td>
                    <input  class="form-control" value="<?php echo $row["received_qty"]; ?>" readonly>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php
    break;


        
        
        
}
