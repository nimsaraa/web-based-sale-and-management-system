<?php 

include '../commons/session.php';
include_once '../Model/customer_model.php';

$userrow = $_SESSION["user"];
$customerObj=new Customer();
$cus_id=$_GET["cus_id"];
$cus_id=base64_decode($_GET["cus_id"]);
$customerResult=$customerObj->getCustomer($cus_id);
$customerdetailrow=$customerResult->fetch_assoc();
$customercontactResult=$customerObj->getCustomerContact($cus_id);
$contactrow1=$customercontactResult->fetch_assoc();
$contactrow2=$customercontactResult->fetch_assoc();



?>

<html>
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
    </head>
    <body>
        <div class="container">
             <?php
            $pageName = "VIEW CUSTOMER"
            ?>
            <?php
            include_once '../includes/header_row_includes.php';
            ?>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    &nbsp;
                </div>
            </div>
            <div style="height: 50px" align="center">
                <div class="col-md-12"  >

                    <div class="col-md-3">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="customer.php">
                                    <span class="glyphicon glyphicon-home"></span> &nbsp;
                                    Customer Menu
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center" >
                                <a href="add-customer.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add Customer
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-customers.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Customers
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="customer-report.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Generate Customer reports
                                </a>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            
                            <div class="row">
                                <h2>Customer Details</h2>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>First Name</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $customerdetailrow["cus_fname"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Last Name</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $customerdetailrow["cus_lname"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Email</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $customerdetailrow["cus_email"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Address</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $customerdetailrow["cus_address"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Contact number 01</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $contactrow1["contact_number"]; ?></h3>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Contact number 02</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $contactrow2["contact_number"]; ?></h3>
                            </div>
                        </div>
                        
                        
                    </div>
                   

               

            </div>
            </div>
            
        </div>
    </body>
    
</html>
    
    
