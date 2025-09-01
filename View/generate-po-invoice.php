<?php

include_once '../Model/purchase_model.php';
include_once '../commons/db_connection.php';
include_once '../commons/session.php';
require('../commons/fpdf186/fpdf.php');

$purchaseObj = new Purchase();

$po_id = base64_decode($_GET["po_id"]);
$purchaseresult = $purchaseObj->getpo($po_id);
$poItemresult = $purchaseObj->getpoItems($po_id);
$purchaserow = $purchaseresult->fetch_assoc();
$userrow = $_SESSION["user"];

$date = date("Y-m-d");
$fpdf = new FPDF("P", "mm", "A4");

$fpdf->SetTitle("purchase-order-invoice");

// Add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);

// Title


$fpdf->cell(0,30,"PURCHASE ORDER INVOICE",0,1,"C");
$fpdf->SetFontSize("12");
$fpdf->cell(0,30,"Generated date: $date .",0,1,"L");
// Supplier & Order Info


$fpdf->Cell(50, 8, "Supplier Name:", 0, 0);
$fpdf->Cell(80, 8, $purchaserow["Supplier_name"], 0, 1);

$fpdf->Cell(50, 8, "PO Date:", 0, 0);
$fpdf->Cell(80, 8, $purchaserow["po_date"], 0, 1);

$fpdf->Cell(50, 8, "Issued By:", 0, 0);
$fpdf->Cell(80, 8, $userrow["user_fname"] . " " . $userrow["user_lname"], 0, 1);

$fpdf->Cell(50, 8, "Total Amount (Rs.):", 0, 0);
$fpdf->Cell(80, 8, number_format($purchaserow["po_total"], 2), 0, 1);



// Table Headers


$fpdf->Cell(60, 10, "Raw Material", 1, 0, "C");
$fpdf->Cell(30, 10, "Unit Price", 1, 0, "C");
$fpdf->Cell(25, 10, "Quantity", 1, 0, "C");
$fpdf->Cell(25, 10, "Unit", 1, 0, "C");
$fpdf->Cell(40, 10, "Total Price", 1, 1, "C");

// Table Data

while ($row = $poItemresult->fetch_assoc()) {
    $fpdf->Cell(60, 10, $row["raw_name"], 1);
    $fpdf->Cell(30, 10, number_format($row["unit_price"], 2), 1, 0, "R");
    $fpdf->Cell(25, 10, $row["qty"], 1, 0, "R");
    $fpdf->Cell(25, 10, $row["unit_name"], 1, 0, "C");
    $fpdf->Cell(40, 10, number_format($row["total_price"], 2), 1, 1, "R");
}



$fpdf->Cell(140, 10, "Po Total Amount(Rs.):", 1, 0, "R");
$fpdf->Cell(40, 10, number_format($purchaserow["po_total"], 2), 1, 1, "R");


$fpdf->SetFontSize("10");
$fpdf->Cell(0, 10, "This is a computer generated document. No signature is required.", 0, 1, "L");

// Output PDF
$fpdf->Output();
