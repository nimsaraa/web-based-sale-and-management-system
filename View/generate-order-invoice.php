<?php

include_once '../Model/order_model.php';
include_once '../commons/db_connection.php';
include_once '../commons/session.php';
require('../commons/fpdf186/fpdf.php');

$orderObj = new Order();

$order_id = base64_decode($_GET["order_id"]);
$orderResult = $orderObj->getorder($order_id);
$orderItemResult = $orderObj->getorderItems($order_id);
$orderRow = $orderResult->fetch_assoc();
$userrow = $_SESSION["user"];

$date = date("Y-m-d");

$fpdf = new FPDF("P", "mm", "A4");
$fpdf->SetTitle("order-invoice");
$fpdf->AddPage("P", "A4");

// Logo and Title
$fpdf->SetFont("Arial", "", 18);
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);
$fpdf->Cell(0, 30, "ORDER INVOICE", 0, 1, "C");

$fpdf->SetFontSize(12);
$fpdf->Cell(0, 10, "Generated date: $date", 0, 1, "L");

// Order Info
$fpdf->Cell(50, 8, "Customer Name:", 0, 0);
$fpdf->Cell(80, 8, $orderRow["cus_fname"] . " " . $orderRow["cus_lname"], 0, 1);

$fpdf->Cell(50, 8, "Order Date:", 0, 0);
$fpdf->Cell(80, 8, $orderRow["order_date"], 0, 1);


$fpdf->Cell(50, 8, "Payment Type:", 0, 0);
$fpdf->Cell(80, 8, $orderRow["payment_type"], 0, 1);

$fpdf->Cell(50, 8, "Total Amount (Rs.)", 0, 0);
$fpdf->Cell(80, 8, number_format($orderRow["total"], 2), 0, 1);

// Table Header
$fpdf->SetFont("Arial", "B", 11);
$fpdf->Cell(60, 10, "Product", 1, 0, "C");
$fpdf->Cell(20, 10, "Size", 1, 0, "C");
$fpdf->Cell(20, 10, "Color", 1, 0, "C");
$fpdf->Cell(20, 10, "Qty", 1, 0, "C");
$fpdf->Cell(30, 10, "Unit Price", 1, 0, "C");
$fpdf->Cell(40, 10, "Total Price", 1, 1, "C");

// Table Data
$fpdf->SetFont("Arial", "", 11);
while ($row = $orderItemResult->fetch_assoc()) {
    $fpdf->Cell(60, 10, $row["product_name"], 1);
    $fpdf->Cell(20, 10, $row["size"], 1, 0, "C");
    $fpdf->Cell(20, 10, $row["colour"], 1, 0, "C");
    $fpdf->Cell(20, 10, $row["quantity"], 1, 0, "R");
    $fpdf->Cell(30, 10, number_format($row["unit_price"], 2), 1, 0, "R");
    $fpdf->Cell(40, 10, number_format($row["total_price"], 2), 1, 1, "R");
}

// Total Summary
$fpdf->SetFont("Arial", "B", 11);
$fpdf->Cell(150, 10, "Order Total Amount (Rs.):", 1, 0, "R");
$fpdf->Cell(40, 10, number_format($orderRow["total"], 2), 1, 1, "R");

// Footer
$fpdf->SetFontSize(10);
$fpdf->Cell(0, 10, "This is a computer generated document. No signature is required.", 0, 1, "L");

// Output PDF
$fpdf->Output();
