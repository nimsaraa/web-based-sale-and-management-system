<?php 

include '../commons/session.php';
include_once '../Model/customer_model.php';

$userrow = $_SESSION["user"];
$customerObj=new Customer();
$activeResult=$customerObj->getActivateCustomercount();
$activate_row=$activeResult->fetch_assoc();
$countResult=$customerObj->getCustomerCount();
$count_row=$countResult->fetch_assoc();

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
            $pageName = "CUSTOMER MANAGEMENT"
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
                <div class="col-md-12">
                    
                    
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
                    
                    <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px;">
                        <div class="panel-heading">
                            <p align="center">Total Customers</p>
                        </div>
                        
                        <div class="panel-body">
                            <h1 class="h1" align="center"><?php echo $count_row["customer_count"]; ?></h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="panel panel-info" style="height:180px">
                        <div class="panel-heading">
                            <p align="center">Active customers</p>
                        </div>
                        
                        <div class="panel-body">
                            <h1 class="h1" align="center"><?php echo $activate_row["customer_count"]; ?></h1>
                        </div>
                    </div>
                </div>
                   

               

            </div>
            </div>
            
        </div>
    </body>
    
</html>
    
    