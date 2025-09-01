<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Purchase{
    
    public function addPurchaseOrder($sup_id, $user_id, $po_date, $po_total) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO purchase_order (sup_id, user_id, po_date, po_total) VALUES ('$sup_id', '$user_id', '$po_date', '$po_total')";
        $con->query($sql) or die ($con->error);
        $po_id=$con->insert_id;
        return $po_id;
    }
    
    public function addPurchaseOrderItem($po_id, $raw_id, $unit_price, $quantity, $unit_id, $total_price) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO purchase_order_item (po_id, raw_id, unit_price, qty, unit_id, total_price) 
            VALUES ('$po_id', '$raw_id', '$unit_price', '$quantity', '$unit_id', '$total_price')";
        $con->query($sql) or die($con->error);
        $po_item_id = $con->insert_id;
        return $po_item_id;
    }
    
    public function getAllPo() {
        $con = $GLOBALS["con"];
        $sql = "SELECT pr.*, s.Supplier_name, u.user_fname,u.user_lname"
                . " FROM purchase_order pr JOIN supplier s ON pr.sup_id = s.sup_id"
                . " JOIN `user` u ON pr.user_id = u.user_id WHERE purchase_status!=-1" ;
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    public function getpo($po_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT pr.*,s.Supplier_name,u.user_fname,u.user_lname"
                . " FROM purchase_order pr "
                . "JOIN supplier s ON pr.sup_id = s.sup_id"
                . " JOIN `user` u ON pr.user_id = u.user_id"
                . " WHERE  po_id='$po_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function getpoItems($po_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT pi.*,r.raw_name, u.unit_name "
                . " FROM purchase_order_item pi JOIN units u ON pi.unit_id=u.unit_id JOIN raw_material r ON pi.raw_id = r.raw_id"
                . " WHERE  po_id='$po_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function deletePo($po_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE purchase_order SET purchase_status='-1' WHERE po_id='$po_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function deletePoItems($po_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM purchase_order_item WHERE po_id='$po_id'";
             $result=$con->query($sql)or die($con->error);
             return $result;
             
         }
    public function UpdatePurchaseOrder($sup_id, $user_id, $po_date, $po_total, $po_id) {
    $con = $GLOBALS["con"];
    $sql = "UPDATE purchase_order 
            SET sup_id='$sup_id', user_id='$user_id', po_date='$po_date', po_total='$po_total' 
            WHERE po_id='$po_id'";
    $result = $con->query($sql) or die($con->error);
    return $result; 
}

   public function updatePurchaseOrderItem($po_id, $raw_id, $unit_price, $quantity, $unit_id, $total_price, $po_item_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE purchase_order_item 
            SET po_id='$po_id', raw_id='$raw_id', unit_price='$unit_price', qty='$quantity', unit_id='$unit_id', total_price='$total_price' 
            WHERE po_item_id='$po_item_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }

    public function addGRN($po_id,  $user_id,$grn_date,) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO grn (po_id,user_id, grn_date) VALUES ('$po_id',  '$user_id','$grn_date')";
        $con->query($sql) or die($con->error);
        $grn_id = $con->insert_id;
        return $grn_id;
    }

    public function addGRNItem($grn_id, $raw_id, $received_qty, $unit_id) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO grn_item (grn_id, raw_id, received_qty, unit_id)
                VALUES ('$grn_id', '$raw_id', '$received_qty', '$unit_id')";
        $con->query($sql) or die($con->error);
        $grn_item_id = $con->insert_id;
        return $grn_item_id;
    }
    public function getAllGrn() {
             $con=$GLOBALS["con"];
             $sql="SELECT g.* , u.user_fname, u.user_lname FROM grn g JOIN user u ON g.user_id=u.user_id WHERE grn_status!=-1";
             $result=$con->query($sql)or die($con->error);
             return $result;
             
         }
         
         public function deletegrn($grn_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE grn SET grn_status='-1' WHERE grn_id='$grn_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function deleteGrnItems($grn_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM grn_item WHERE grn_id='$grn_id'";
             $result=$con->query($sql)or die($con->error);
             return $result;
             
         }
         
      public function getGrnItems($grn_id) {
    $con = $GLOBALS["con"];
    $sql = "SELECT gi.*, r.raw_name, u.unit_name,
                   poi.qty AS ordered_qty
            FROM grn_item gi
            JOIN raw_material r ON gi.raw_id = r.raw_id
            JOIN units u ON gi.unit_id = u.unit_id
            JOIN grn g ON g.grn_id = gi.grn_id
            JOIN purchase_order_item poi ON poi.raw_id = gi.raw_id AND poi.po_id = g.po_id
            WHERE gi.grn_id = '$grn_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

    
    public function getGrn($grn_id) {
    $con = $GLOBALS["con"];
    $sql = "SELECT g.*, u.user_fname, u.user_lname, po.po_date
            FROM grn g
            JOIN user u ON g.user_id = u.user_id
            JOIN purchase_order po ON g.po_id = po.po_id
            WHERE g.grn_id = '$grn_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}

public function updateGRN($grn_id, $po_id, $user_id, $grn_date) {
    $con = $GLOBALS["con"];
    $sql = "UPDATE grn 
            SET po_id = '$po_id', user_id = '$user_id', grn_date = '$grn_date' 
            WHERE grn_id = '$grn_id'";
    $con->query($sql) or die($con->error);
}

public function getTotalPOCount() {
    $con = $GLOBALS["con"];
    $sql = "SELECT COUNT(*) AS po_count FROM purchase_order";
    return $con->query($sql);
}

public function getTotalGRNCount() {
    $con = $GLOBALS["con"];
    $sql = "SELECT COUNT(*) AS grn_count FROM grn";
    return $con->query($sql);
}





         
    
    

    
}



