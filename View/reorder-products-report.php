<?php

include_once '../model/inventory_model.php';

$stockObj=new Stock();
$stockResult=$stockObj->getReorderStock();

//include the library
include '../commons/fpdf186/fpdf.php';

$fpdf= new FPDF("P");

//document title
$fpdf->SetTitle("reorder-items-report");
$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);

//page title
$fpdf->cell(0,30,"REORDER PRODUCT REPORT",0,1,"C");
$fpdf->SetFontSize("12");
$fpdf->cell(0,30,"The reorder item list as of $date are as below.",0,1,"L");

//header
$fpdf->cell(20,10,"SKU_id",1,0,"C");
$fpdf->cell(60,10,"product",1,0,"C");
$fpdf->cell(20,10,"colour",1,0,"C");
$fpdf->cell(20,10,"size",1,0,"C");
$fpdf->cell(20,10,"avail_qty",1,0,"C");
$fpdf->cell(40,10,"Reorder_level",1,1,"C");

//data

while($stockrow=$stockResult->fetch_assoc()){
    $fpdf->SetFontSize("11");
    $fpdf->cell(20,10,$stockrow['sku_id'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(60,10,$stockrow['product_name'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(20,10,$stockrow['colour'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(20,10,$stockrow['size'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(20,10,$stockrow['total_quantity'],1,0,"R");
    $fpdf->SetFontSize("11");
    $fpdf->cell(40,10,$stockrow['reorder_level'],1,1,"R");
    

    
}

$fpdf->SetFontSize("10");
$fpdf->cell(0,30,"This is a computer genarated document and no requires authorizes signature.",0,1,"L");


$fpdf->Output();