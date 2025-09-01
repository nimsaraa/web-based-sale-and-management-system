<?php 

include '../commons/session.php';
include_once '../Model/supplier_model.php';

$userrow = $_SESSION["user"];
$supplierObj = new Supplier();
$supplierResult =$supplierObj->getAllSuppliers();

?>
<html>
    <head>
        <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
        <link rel="stylesheet"  type="text/css" href="../css/dataTables.bootstrap.min.css"/>
    </head>
    <body>
        <div class="container">
            <?php
            $pageName = "VIEW SUPPLIERS"
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
                    
                    <div class="row">
                        <div class="col-md-12">
                            &nbsp;
                        </div>
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET["msg"])) {
                            $msg = base64_decode($_GET["msg"]);
                            ?>

                            <div class="row">
                                <div class="alert alert-success">
                                    <center>
                                        <span class="glyphicon glyphicon-saved">
                                            &nbsp;
                                            <?php
                                            echo $msg;
                                            ?>
                                        </span>
                                    </center>
                                </div>
                            </div>

                            <?php
                               }
                            ?>

                        <div class="row">
                            &nbsp;
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <table  class="table table-hover" id="suppliertable">
                                    <thead class="thead-dark">
                                <tr>
                                    
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                  
                                  
                                while($supplierrow=$supplierResult->fetch_assoc()){
                                    
                                    $sup_id=$supplierrow["sup_id"];
                                    $sup_id= base64_encode($sup_id);
                                    
                                    $status="Active";
                                    
                                    if($supplierrow["supplier_status"]==0){
                                        $status="Deactive";
                                    }
                                  
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        
                                                    
                                                 echo  $supplierrow["Supplier_name"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo $supplierrow["sup_email"];
                                        ?>
                                    </td>
                                    <td
                                        <?php
                                            if($supplierrow["supplier_status"]==1){
                                        ?>
                                        
                                            class="success"
                                        <?php
                                        }else if($supplierrow["supplier_status"]==0){
                                            ?>
                                        class="danger"
                                        <?php
                                            }
                                        ?>
                                        >
                                        <?php
                                            echo $status;
                                        
                                        ?>
                                    </td>
                                    <td>
                                        
                                        <a href="view-supplier.php?sup_id=<?php echo $sup_id; ?>" class="btn btn-info">
                                                View
                                                &nbsp;
                                                <span class="glyphicon glyphicon-search">
                                                </span>
                                            </a>
                                        <a href="edit-supplier.php?sup_id=<?php echo $sup_id;?>" class="btn btn-warning">
                                                Edit
                                                &nbsp;
                                                <span class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a>
                                        <?php
                                         if ($supplierrow["supplier_status"]==0){
                                         ?>  
                                     
                                        <a href="../controller/supplier_controller.php?status=activate&sup_id=<?php echo $sup_id; ?>" class="btn btn-success">
                                            Activate
                                            &nbsp;
                                            <span class="glyphicon glyphicon-ok">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        <?php
                                         if ($supplierrow["supplier_status"]==1){
                                         ?>  
                                     
                                        <a href="../controller/supplier_controller.php?status=deactivate&sup_id=<?php echo $sup_id; ?>" class="btn btn-danger">
                                            DeActivate
                                            &nbsp;
                                            <span class="glyphicon glyphicon-remove">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        <a href="../controller/supplier_controller.php?status=delete&sup_id=<?php echo $sup_id; ?>" class="btn btn-danger">
                                                Delete
                                                &nbsp;
                                                <span class="glyphicon glyphicon-trash">
                                                </span>
                                            </a>
                                        <a href="view-invoice.php?sup_id=<?php echo $sup_id; ?>" class="btn btn-primary">
                                                View Invoices
                                                &nbsp;
                                                <span class="glyphicon glyphicon-search">
                                                </span>
                                            </a>
                                    </td>
                                </tr>
                                
                                                             
                                
                                   <?php
                                   }
                                   ?>                            
                                               
                            </tbody>
                                    
                                </table>
                                
                            </div>
                            
                        </div>
                        
                        
                    </div>
                   

               

            </div>
            </div>
            
        </div>
    </body>
    <script src="../JS/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
        $("#suppliertable").DataTable();
    });
    
    
    </script>


</html>

