<?php

include_once '../model/order_model.php';

$orderObj=new Order();
$orderResult=$orderObj->getAllorders();

//include the library
include '../commons/fpdf186/fpdf.php';

$fpdf= new FPDF("P");

//document title
$fpdf->SetTitle(" orders list report");
$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);

//page title
$fpdf->cell(0,30,"Orders list report",0,1,"C");
$fpdf->SetFontSize("12");
$fpdf->cell(0,30,"The order list  as of $date are as below.",0,1,"L");

//header

$fpdf->cell(80,10,"Customer name",1,0,"C");
$fpdf->cell(40,10,"Order date",1,0,"C");
$fpdf->cell(40,10,"Total amount (RS)",1,1,"C");


//data

while($orderRow=$orderResult->fetch_assoc()){
    
    
    
    $fpdf->cell(80,10,$orderRow['cus_fname']." ".$orderRow['cus_lname'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(40,10,$orderRow['order_date'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(40,10, number_format($orderRow['total'],2),1,1,"R");
    $fpdf->SetFontSize("11");
  

    
}

$fpdf->SetFontSize("10");
$fpdf->cell(0,30,"This is a computer genarated document and no requires authorizes signature",0,1,"L");


$fpdf->Output();