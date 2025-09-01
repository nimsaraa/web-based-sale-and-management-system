<?php
include '../commons/session.php';


$status = $_GET["status"];

include '../Model/order_model.php';


$orderObj= new Order();


switch($status){ 
  case "add_order":
        $cus_id      = $_POST["cus_id"];
        $po_date     = $_POST["ordate"];
        $payement    =$_POST["payement"];
        $total    = $_POST["total"];

        $product_ids      = $_POST["product"];
        $size_ids             =$_POST["size"];
        $colour_ids           =$_POST["colour"];
        $unit_prices  = $_POST["unit_price"];
        $quantities   = $_POST["quantity"];
        $total_prices = $_POST["total_price"];

        try {
            
            if($quantities==""){
                throw new Exception("quantity cannot be empty!");
            }
            if($quantities<0){
                throw new Exception("quantity cannot be empty!");
            }
            
            
            
            
            $order_id = $orderObj->addOrder($cus_id,$po_date,$payement, $total);

            for ($i = 0; $i < count($product_ids); $i++) {
                $orderObj->addOrderItem(
                    $order_id,
                    $product_ids[$i],
                        $size_ids[$i],
                        $colour_ids[$i],
                    $unit_prices[$i],
                    $quantities[$i],
                   
                    $total_prices[$i]
                );
            }

            $msg = "Successfully added!";
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/view-orders.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } 
        catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-order.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
        }

            break;
            
             case "delete":
            $order_id = $_GET["order_id"];
            $order_id = base64_decode($order_id);
            $orderObj->deleteorder($order_id);
            $orderObj->deleteOrderItems($order_id);
            
                
                
            $msg = "Successfully Deleted!!!";
            $msg = base64_encode($msg);
            ?>
                        <script>
                        window.location="../view/view-orders.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
            break;
        
        case "edit_order":
        $cus_id      = $_POST["cus_id"];
        $po_date     = $_POST["ordate"];
        $payement    =$_POST["payement"];
        $total    = $_POST["total"];
        $order_id   =$_POST["order_id"];

        $product_ids      = $_POST["product"];
        $size_ids             =$_POST["size"];
        $colour_ids           =$_POST["colour"];
        $unit_prices  = $_POST["unit_price"];
        $quantities   = $_POST["quantity"];
        $total_prices = $_POST["total_price"];
        

        try {
            if($quantities==""){
                throw new Exception("quantity cannot be empty!");
            }
            if($quantities<0){
                throw new Exception("quantity cannot be empty!");
            }
            
            $orderObj->updateOrder($cus_id,$po_date,$payement, $total,$order_id);
            $orderObj->deleteOrderItems($order_id);

            for ($i = 0; $i < count($product_ids); $i++) {
                $orderObj->addOrderItem(
                    $order_id,
                    $product_ids[$i],
                        $size_ids[$i],
                        $colour_ids[$i],
                    $unit_prices[$i],
                    $quantities[$i],
                   
                    $total_prices[$i]
                );
            }

            $msg = "Successfully updated!";
            $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/view-orders.php?msg=<?php echo $msg; ?>";
            </script>
            <?php
        } 
        catch (Exception $ex) {
                $msg = $ex->getMessage();
                $msg = base64_encode($msg);
                ?>
                  <script>
                    window.location="../view/add-order.php?msg=<?php echo $msg; ?>";
                </script>
                <?php
        }

            break;

    case "payed":
        $order_id = $_GET["order_id"];
        $decoded_id = base64_decode($order_id);
        $orderObj->activatepay($decoded_id);
        $msg = "Successfully changed status!!!";
        $msg = base64_encode($msg);
            ?>
            <script>
                window.location = "../view/order-payment.php?order_id=<?php echo $order_id; ?>&msg=<?php echo $msg; ?>";
            </script>
        <?php
        break;
}