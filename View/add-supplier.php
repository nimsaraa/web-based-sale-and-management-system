<?php 

include '../commons/session.php';
include_once '../Model/supplier_model.php';

$userrow = $_SESSION["user"];
$supplierObj=new Supplier();


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
            $pageName = "ADD SUPPLIER"
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
                <div class="">
                    
                     <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="supplier.php">
                            <span class="glyphicon glyphicon-home"></span> &nbsp;
                            Supplier Menu
                        </a>
                    </div>
                </div>
                
            </div>
                
                <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center" >
                        <a href="add-supplier.php">
                            <span class="glyphicon glyphicon-plus"></span> &nbsp;
                            Add Supplier
                        </a>
                    </div>
                </div>
                
            </div>
                <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="view-suppliers.php">
                            <span class="glyphicon glyphicon-search"></span> &nbsp;
                            View Suppliers
                        </a>
                    </div>
                </div>
                
            </div>

                <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="supplier-report.php">
                            <span class="glyphicon glyphicon-book"></span> &nbsp;
                            Generate Supplier reports
                        </a>
                    </div>
                </div>
            </div>
                    <div class="col-md-2">

                <div class="panel panel-primary" style="height:40px;">
                    <div class="text-center">
                        <a href="supplier-invoice.php">
                            <span class="glyphicon glyphicon-list-alt"></span> &nbsp;
                            Add Supplier Invoices
                        </a>
                    </div>
                </div>
            </div>

                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    </div>
                    <form action="../Controller/supplier_controller.php?status=add_supplier" method="post" enctype="multipart/form-data">
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
                                    <label class="control-label">Supplier Name</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="sname" id="sname"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Email</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="email" class="form-control" name="email" id="email"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Address</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="address" id="address"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="control-label">Contact number</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="cno" id="cno"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>

                            <div class="row"> 
                                <div class="col-md-2">
                                    <label class="control-label">Supplier NAT No</label>
                                </div>


                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="natno" id="natno" placeholder="9 digits with X / 10 digits"/>
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
        </form
            </div>
            
       
    </body>
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/suppliervalidations.js"></script>
</html>
    
    