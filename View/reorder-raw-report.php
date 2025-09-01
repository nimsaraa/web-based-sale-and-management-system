<?php

include_once '../model/inventory_model.php';

$stockObj=new Stock();
$stockResult=$stockObj->getReorderRaws();

//include the library
include '../commons/fpdf186/fpdf.php';

$fpdf= new FPDF("P");

//document title
$fpdf->SetTitle("reorder_raw_report");
$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);

//page title
$fpdf->cell(0,30,"REORDER  RAW ITEMS REPORT",0,1,"C");
$fpdf->SetFontSize("12");
$fpdf->cell(0,30,"The reorder item list as of $date are as below.",0,1,"L");

//header
$fpdf->cell(20,10,"Raw_id",1,0,"C");
$fpdf->cell(60,10,"Raw_material",1,0,"C");
$fpdf->cell(20,10,"avail_qty",1,0,"C");
$fpdf->cell(40,10,"Reorder_level",1,1,"C");

//data

while($stockrow=$stockResult->fetch_assoc()){
    $fpdf->SetFontSize("11");
    $fpdf->cell(20,10,$stockrow['raw_id'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(60,10,$stockrow['raw_name'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(20,10,$stockrow['quantity']." ".$stockrow['unit_name'],1,0,"R");
    $fpdf->SetFontSize("11");
    $fpdf->cell(40,10,$stockrow['reorder_level'].(!empty($stockrow["unit_name"]) ? ' ' . $stockrow["unit_name"] : ''),1,1,"R");
    

    
}

$fpdf->SetFontSize("10");
$fpdf->cell(0,30,"This is a computer genarated document and no requires authorizes signature.",0,1,"L");


$fpdf->Output();