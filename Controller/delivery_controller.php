<?php

include '../commons/session.php';


$status = $_GET["status"];

include '../Model/delivery_model.php';

$delobj=new Delivery();

switch($status){
    
    case"add_vehicle":


        $v_no = $_POST["vno"];
        $v_type = $_POST["vtype"];

        try {

            $vehicle_id = $delobj->addVehicle($v_no, $v_type);

            $msg = "vehicle $v_no Succesfully Added!";
            $msg = base64_encode($msg);
                            ?>
                        <script>
                            window.location = "../view/view-vehicles.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
            ?>

                <script>
                window.location="../view/add-vehicle.php?msg=<?php echo $msg; ?>";
                </script>
               
        <?php
        break;
    
    
    case"edit_vehicle":


        $v_no = $_POST["vno"];
        $v_type = $_POST["vtype"];
        $vehicle_id=$_POST["vehicle_id"];

        try {

            $delobj->UpdateVehicle($v_no, $v_type,$vehicle_id);

            $msg = "vehicle $v_no Succesfully Edited!!";
            $msg = base64_encode($msg);
                            ?>
                        <script>
                            window.location = "../view/view-vehicles.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
            ?>

                <script>
                window.location="../view/add-vehicle.php?msg=<?php echo $msg; ?>";
                </script>
               
        <?php
        break;
    
    case "delete_vehicle":

        $vehicle_id = $_GET["vehicle_id"];
        $vehicle_id = base64_decode($vehicle_id);

        $delobj->deleteVehicle($vehicle_id);
        $msg = "Successfully Deleted!!!";
        $msg = base64_encode($msg);
            ?>
             <script>
                window.location="../view/view-vehicles.php?msg=<?php echo $msg; ?>";
            </script>
                
        <?php
        break;
    
    case"add_delivery":


        $order_id = $_POST["order"];
        $pay_type_id = $_POST["pay_type_id"];

        $vehicle=$_POST["vehicle"];

        try {

            $delivery_id = $delobj->addDelivery($order_id, $pay_type_id,$vehicle);

            $msg = "Delivery Succesfully Assigned!";
            $msg = base64_encode($msg);
                            ?>
                        <script>
                            window.location = "../view/view-deliverys.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
            ?>

                <script>
                window.location="../view/add-delivery.php?msg=<?php echo $msg; ?>";
                </script>
               
        <?php
        break;
    
    
    case"edit_delivery":


        $order_id = $_POST["order"];
        $pay_type_id = $_POST["pay_type_id"];

        $vehicle=$_POST["vehicle"];
        $delivery_id=$_POST["delivery_id"];

        try {

              $delobj->Updatedelivery($order_id, $pay_type_id,$vehicle,$delivery_id);

            $msg = "Delivery  Succesfully Updated!";
            $msg = base64_encode($msg);
                            ?>
                        <script>
                            window.location = "../view/view-deliverys.php?msg=<?php echo $msg; ?>";
                        </script>
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
        }
            ?>

                <script>
                window.location="../view/add-delivery.php?msg=<?php echo $msg; ?>";
                </script>
               
        <?php
        break;
    
    
    case "delivered":
            $delivery_id = $_GET["delivery_id"];
            $delivery_id = base64_decode($delivery_id);
            $delobj->deliveredStatus($delivery_id);
            $msg = "Successfully changed status!!!";
            $msg = base64_encode($msg);
            ?>
            <script>
            window.location="../view/view-deliverys.php?msg=<?php echo $msg; ?>";
            </script>
        <?php
        break;
    
     case "delete_delivery":

        $delivery_id = $_GET["delivery_id"];
        $delivery_id = base64_decode($delivery_id);

        $delobj->deleteDelivery($delivery_id);
        $msg = "Successfully Deleted!!!";
        $msg = base64_encode($msg);
            ?>
             <script>
                window.location="../view/view-deliverys.php?msg=<?php echo $msg; ?>";
            </script>
                
        <?php
        break;
    
    
    
}