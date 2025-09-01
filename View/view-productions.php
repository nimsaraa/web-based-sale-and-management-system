<?php

include_once '../commons/session.php';
include_once '../Model/production_model.php';

$userrow = $_SESSION["user"];
$productionObj= new Production();
$productionResult=$productionObj->getAllProductions();

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
            $pageName = "VIEW PRODUCTIONS"
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
                   
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="view-productions.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    View Productions
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="add-production.php">
                                    <span class="glyphicon glyphicon-plus"></span> &nbsp;
                                    Add Production
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="production-reports.php">
                                    <span class="glyphicon glyphicon-search"></span> &nbsp;
                                    Reports
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
                                $msg= base64_decode($_GET["msg"]);
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
                        <table class="table table-hover" id="protable">
                            <thead class="thead-dark">
                                <tr>
                                    
                                    <th>Pro Id</th>
                                    <th>SKU Id</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                                
                                while ($productionRow=$productionResult->fetch_assoc()){
                                    $pro_id=$productionRow["pro_id"];
                                    $pro_id= base64_encode($pro_id);
                                    
                                    
                                    
                                    $status="Complete";
                                    
                                    if($productionRow["p_status"]==0){
                                        $status="Ongoing";
                                    }
                                              
                                   ?>            
                                                
                                            
                                <tr>
                                    <td>
                                        <?php
                                                    
                                                 echo  $productionRow["pro_id"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                    
                                                 echo  $productionRow["sku_id"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        
                                        echo  $productionRow["p_qty"]
                                        ?>
                                    </td>
                                    <td
                                        <?php
                                            if($productionRow["p_status"]==1){
                                        ?>
                                        
                                            class="success"
                                        <?php
                                        }else if($productionRow["p_status"]==0){
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
                                        
                                        
                                         <?php
                                         if ($productionRow["p_status"]==0){
                                         ?>  
                                     
                                        <a href="../controller/production_controller.php?status=complete&pro_id=<?php echo $pro_id; ?>" class="btn btn-success">
                                            Complete
                                            &nbsp;
                                            <span class="glyphicon glyphicon-ok">
                                            </span>
                                            
                                        </a> 
                                        <?php
                                         }
                                         ?>
                                        
                                        
                                        
                                        <a href="view-production.php?pro_id=<?php echo $pro_id;?>" class="btn btn-info">
                                            View
                                            &nbsp;
                                            <span class="glyphicon glyphicon-search">
                                            </span>
                                           
                                            
                                        </a> 
                                        
                                        
                                        <a href="edit-production.php?pro_id=<?php echo $pro_id;?>" class="btn btn-warning">
                                            Edit
                                            &nbsp;
                                            <span class="glyphicon glyphicon-pencil">
                                            </span>
                                            
                                        </a> 
                                      
                                        
                                        <a href="../controller/production_controller.php?status=delete&pro_id=<?php echo $pro_id; ?>" class="btn btn-danger">
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
    </body>
    <script src="../JS/datatable/jquery-3.5.1.js"></script>
    <script src="../JS/datatable/jquery.dataTables.min.js"></script>
    <script src="../JS/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  
    <script>
        $(document).ready(function (){
        $("#protable").DataTable();
    });
    
    
    </script>
    
</html>