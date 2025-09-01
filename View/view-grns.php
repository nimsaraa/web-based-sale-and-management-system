<?php

include_once '../commons/session.php';
include_once '../Model/purchase_model.php';

$userrow = $_SESSION["user"];
$purchaseObj= new Purchase();
$purchaseresult=$purchaseObj->getAllGrn();

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
            $pageName = "VIEW GRNs"
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
                   
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-po.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View purchase orders
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-po.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add PO
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-grns.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-grn.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add GRN
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="grn-report.php">
                                    <span class="glyphicon glyphicon-book"></span> &nbsp;
                                    Purchase Reports
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                <table  class="table table-hover" id="grntable">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th>PO ID</th>
                                            <th>User ID</th>
                                            <th>GRN Date</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    
                                    
                                    <tbody>
                                <?php
                                                  
                                  
                                while($purchaserow=$purchaseresult->fetch_assoc()){
                                    
                                    $grn_id=$purchaserow["grn_id"];
                                    $grn_id= base64_encode($grn_id);
                                  
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        
                                                    
                                                 echo  $purchaserow["po_id"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo $purchaserow["user_fname"]." ".$purchaserow["user_lname"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo $purchaserow["grn_date"];
                                        ?>
                                    </td>
                                    <td>
                                        <a href="view-grn.php?grn_id=<?php echo $grn_id; ?>" class="btn btn-info">
                                                View
                                                &nbsp;
                                                <span class="glyphicon glyphicon-search">
                                                </span>
                                            </a>
                                        <a href="edit-grn.php?grn_id=<?php echo $grn_id;?>" class="btn btn-warning">
                                                Edit
                                                &nbsp;
                                                <span class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a>
                                        <a href="../controller/purchase_controller.php?status=delete_grn&grn_id=<?php echo $grn_id; ?>" class="btn btn-danger">
                                                Delete
                                                &nbsp;
                                                <span class="glyphicon glyphicon-trash">
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
    <script src="../JS/jquery-3.7.1.js"></script>
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function (){
        $("#grntable").DataTable();
    });
    
    
    </script>
</html>