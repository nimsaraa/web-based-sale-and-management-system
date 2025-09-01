<?php

include_once  '../commons/db_connection.php';

$dbcon = new DbConnection();

class Order{

    public function getAllPayements() {
        $con=$GLOBALS["con"];
        $sql="SELECT * FROM payement_types";
        $result=$con->query($sql)or die($con->error);
        return $result;
        
        
    }
    public function addOrder($cus_id, $order_date,$payement, $total) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO orders (cus_id, order_date,payement,total) VALUES ('$cus_id','$order_date','$payement', '$total')";
        $con->query($sql) or die ($con->error);
        $order_id=$con->insert_id;
        return $order_id;
    }
    
    public function addOrderItem($order_id, $product_id,$size_id,$colour_id, $unit_price, $quantity, $total_price) {
        $con = $GLOBALS["con"];
        $sql = "INSERT INTO order_item (order_id, product_id,size_id,colour_id, unit_price, quantity, total_price) "
                . " VALUES ('$order_id', '$product_id','$size_id','$colour_id' ,'$unit_price', '$quantity', '$total_price')";
        $con->query($sql) or die($con->error);
        $order_item_id = $con->insert_id;
        return $order_item_id;
    }
    public function getAllorders() {
        $con = $GLOBALS["con"];
        $sql = "SELECT o.*, c.cus_fname, c.cus_lname,p.pay_type_id, p.payment_type "
                . " FROM orders o "
                . " JOIN customer c ON o.cus_id = c.cus_id "
                . "JOIN payement_types p ON p.pay_type_id = o.payement "
                . " WHERE order_status!=-1" ;
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function deleteorder($order_id) {
        $con = $GLOBALS["con"];
        $sql = "UPDATE orders SET order_status='-1' WHERE order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    }
    
    public function deleteOrderItems($order_id) {
             $con=$GLOBALS["con"];
             $sql="DELETE FROM order_item WHERE order_id='$order_id'";
             $result=$con->query($sql)or die($con->error);
             return $result;
             
         }
    public function getorder($order_id) {
    $con = $GLOBALS["con"];
    $sql = "SELECT o.*, c.cus_fname, c.cus_lname, p.pay_type_id, p.payment_type "
            . " FROM orders o JOIN customer c ON o.cus_id = c.cus_id "
            . " JOIN payement_types p ON p.pay_type_id = o.payement "
            . " WHERE o.order_id = '$order_id'";
    $result = $con->query($sql) or die($con->error);
    return $result;
}


    public function getorderItems($order_id) {
        $con = $GLOBALS["con"];
        $sql = "SELECT oi.*,p.product_name, s.size,c.colour "
                . " FROM order_item oi  "
                . "JOIN size s ON oi.size_id=s.size_id "
                . "JOIN colour c ON oi.colour_id=c.colour_id"
                . " JOIN product p ON oi.product_id = p.product_id"
                . " WHERE  order_id='$order_id'";
        $result = $con->query($sql) or die($con->error);
        return $result;
    } 
    
    public function updateOrder($cus_id, $order_date, $payement, $total, $order_id) {
    $con = $GLOBALS["con"];
    $sql = "UPDATE orders SET cus_id = '$cus_id', "
            . " order_date = '$order_date', "
            . " payement = '$payement',"
            . "  total = '$total' "
            . " WHERE order_id = '$order_id'";

    $result = $con->query($sql) or die($con->error);
    return $result;
}

public function getTotalSalesByDate() {
    $con = $GLOBALS["con"];
    $sql = "SELECT order_date, SUM(total) AS daily_total "
            . " FROM orders WHERE order_status != -1 "
            . "GROUP BY order_date"
            . " ORDER BY order_date ASC";
    $result = $con->query($sql) or die($con->error);
    return $result;
}
 public function activatepay($order_id) {
        $con=$GLOBALS["con"];
        $sql="UPDATE orders SET pay_status='1' WHERE order_id='$order_id'";
        $result = $con->query($sql) or die ($con->error);

         }
         
         


    
    
    

    
    
}
