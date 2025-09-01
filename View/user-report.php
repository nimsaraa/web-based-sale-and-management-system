<?php

include_once '../model/user_model.php';

$userObj=new User();
$userResult=$userObj->getAllUsers();

//include the library
include '../commons/fpdf186/fpdf.php';

$fpdf= new FPDF("P");

//document title
$fpdf->SetTitle("user report");
$date=date("Y-m-d");

//add page
$fpdf->AddPage("P","A4");
$fpdf->SetFont("Arial","","18");
$fpdf->SetFontSize("18");
$fpdf->Image("../images/logo.png", 10, 20, 20, 20);

//page title
$fpdf->cell(0,30,"USERS REPORT",0,1,"C");
$fpdf->SetFontSize("12");
$fpdf->cell(0,30,"The system users as of $date are as below.",0,1,"L");

//header
$fpdf->cell(60,10,"Name",1,0,"C");
$fpdf->cell(60,10,"Email",1,0,"C");
$fpdf->cell(60,10,"Status",1,1,"C");

//data

while($userrow=$userResult->fetch_assoc()){
    $status=($userrow["user_status"]=="1")?"Active":"Deactive";
    $fpdf->cell(60,10,$userrow['user_fname']." ".$userrow['user_lname'],1,0,"C");
    $fpdf->SetFontSize("11");
    $fpdf->cell(60,10,$userrow['user_email'],1,0,"C");
    $fpdf->SetFontSize("12");
    $fpdf->cell(60,10,$status,1,1,"C");

    
}

$fpdf->SetFontSize("10");
$fpdf->cell(0,30,"This is a computer genarated document and no requires authorizes signature",0,1,"L");


$fpdf->Output();