<?php 

include '../commons/session.php';
include_once '../Model/customer_model.php';

$userrow = $_SESSION["user"];
$customerObj=new Customer();
$cus_id= base64_decode($_GET["cus_id"]);
$customerResult=$customerObj->getCustomer($cus_id);
$contactResult=$customerObj->getCustomerContact($cus_id);

$contactrow1=$contactResult->fetch_assoc();
$contactrow2=$contactResult->fetch_assoc();
$customerrow=$customerResult->fetch_assoc();


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
            $pageName = "EDIT CUSTOMER"
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
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <form action="../Controller/customer_controller.php?status=update_customer" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3" id="msg">

                                </div>
                                <?php
                                if (isset($_GET["msg"])) {
                                    ?>
                                    <div class="col-md-6 col-md-offset-3 alert alert-danger" >
                                        <?php echo base64_decode($_GET["msg"]); ?>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">First Name</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="hidden" class="cus_id"  name="cus_id" value="<?php echo $cus_id ?>" />
                                    <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $customerrow["cus_fname"]; ?>"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Last Name</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $customerrow["cus_lname"]; ?>" />
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Email</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $customerrow["cus_email"]; ?>"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Address</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="address" id="address"value="<?php echo $customerrow["cus_address"]; ?>" />
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Contact Number 01</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="cno1" id="cno1" 
                                        <?php
                                    if ($contactrow1 != null) {
                                        ?>
                                               value="<?php echo $contactrow1["contact_number"]; ?>"
                                               <?php
                                           }
                                           ?> />
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Contact Number 02</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="cno2" id="cno2"
                                               <?php
                                    if ($contactrow2 != null) {
                                        ?>
                                               value="<?php echo $contactrow2["contact_number"]; ?>"
                                               <?php
                                           }
                                           ?>
                                           />
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>
                            
                            
                            <div class="row">

                                <div class="col-md-offset-3 col-md-6">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                    <input type="reset" class="btn btn-danger" value="Reset"/>
                                </div>
                            </div>
                            
                        </div>
                        

                </div>

               
                            
                        
                    </form>
                    
                   

               

            </div>
            </div>
            
        </div>
    </body>
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/customervalidation.js"></script>
</html>
    
    