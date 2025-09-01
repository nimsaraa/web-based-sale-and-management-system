<?php

include_once '../model/customer_model.php';

$customerObj=new Customer();
$customerResult=$customerObj->getAllCustomers();

//include the library
include '../commons/fpdf186/fpdf.php';

$fpdf= new FPDF("P");

//document title
$fpdf->SetTitle("Customer report");
$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);

//page title
$fpdf->cell(0,30,"CUSTOMER REPORT",0,1,"C");
$fpdf->SetFontSize("12");
$fpdf->cell(0,30,"The customers as of $date are as below.",0,1,"L");

//header
$fpdf->cell(60,10,"Name",1,0,"C");
$fpdf->cell(60,10,"Email",1,0,"C");
$fpdf->cell(60,10,"Status",1,1,"C");


//data
while($customerrow=$customerResult->fetch_assoc()){
    
    $status=($customerrow["customer_status"]=="1")?"Active":"Deactive";
    $fpdf->SetFontSize("11");
    $fpdf->cell(60,10,$customerrow['cus_fname']." ".$customerrow['cus_lname'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(60,10,$customerrow['cus_email'],1,0,"C");
    $fpdf->SetFontSize("12");
    $fpdf->cell(60,10,$status,1,1,"C");
    ;

    
}


    


$fpdf->SetFontSize("10");
$fpdf->cell(0,30,"This is a computer genarated document and no requires authorizes signature",0,1,"L");


$fpdf->Output();