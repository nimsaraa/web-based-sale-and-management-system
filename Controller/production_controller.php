<?php
include '../commons/session.php';


$status = $_GET["status"];

include '../Model/production_model.php';

$productionObj= new Production();

switch($status){
    
    case "add_production":

        $sku_id = $_POST["sku_id"];
        $pdescription = $_POST["pdescription"];
        $pdate = $_POST["pdate"];
        $pqty = $_POST["pqty"];

        try {


            $pro_id = $productionObj->addProduction($sku_id, $pdescription, $pdate, $pqty);

            $msg = "production Succesfully Added!";
            $msg = base64_encode($msg);
?>
                
                 <script>
                    window.location="../view/view-productions.php?msg=<?php echo $msg; ?>";
                </script>
                
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
                              <script>
                                window.location="../view/add-production.php?msg=<?php echo $msg; ?>";
                            </script>
            <?php
        }

        break;

    case"delete":
        $pro_id = $_GET["pro_id"];
        $pro_id = base64_decode($pro_id);
        $productionObj->deleteProduction($pro_id);
        $msg = "Successfully Deleted!!!";
        $msg = base64_encode($msg);
            ?>
                 <script>
                  window.location="../view/view-productions.php?msg=<?php echo $msg; ?>";
                </script>
        <?php
        break;
    
    
    case"edit":
        
        $sku_id = $_POST["sku_id"];
        $pdescription = $_POST["pdescription"];
        $pdate = $_POST["pdate"];
        $pqty = $_POST["pqty"];
        $pro_id=$_POST["pro_id"];

        try {


            $pro_id = $productionObj->UpdateProduction($sku_id, $pdescription, $pdate, $pqty,$pro_id);

            $msg = "production  $pro_id Succesfully Updated!";
            $msg = base64_encode($msg);
?>
                
                 <script>
                    window.location="../view/view-productions.php?msg=<?php echo $msg; ?>";
                </script>
                
            <?php
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msg = base64_encode($msg);
            ?>
                              <script>
                                window.location="../view/edit-production.php?msg=<?php echo $msg; ?>";
                            </script>
            <?php
        }

        break;

        
        
        break;
    
    case "complete":
        $pro_id = $_GET["pro_id"];
            $pro_id = base64_decode($pro_id);
            $productionObj->complete($pro_id);
            $msg = "Successfully changed status!!!";
            $msg = base64_encode($msg);
            ?>
            <script>
            window.location="../view/view-productions.php?msg=<?php echo $msg; ?>";
            </script>
        <?php
        
        break;
    case "ongoing":
        $pro_id = $_GET["pro_id"];
            $pro_id = base64_decode($pro_id);
            $productionObj->ongoing($pro_id);
            $msg = "Successfully changed status!!!";
            $msg = base64_encode($msg);
            ?>
            <script>
            window.location="../view/view-productions.php?msg=<?php echo $msg; ?>";
            </script>
        <?php
        
        break;
 
}