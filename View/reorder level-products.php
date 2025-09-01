<?php
 
include_once '../Model/inventory_model.php';

$stockObj=new Stock();
$stockResult=$stockObj->getReorderLeveltock();

?>
<html>
    <head>
         <?php
        include_once '../includes/bootstrap_css_includes.php';
        ?>
        <link rel="stylesheet"  type="text/css" href="../css/dataTables.bootstrap.min.css"/>
    </head>
    <body>
         <div style="height: 50px" align="center">
                <div class="col-md-12">
                    
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
                                <table  class="table table-hover" id="customertable">
                                    <thead class="thead-dark">
                                        <tr>

                                            <th>Sku id</th>
                                            <th>product name</th>
                                            <th>size</th>
                                            <th>colour</th>
                                            <td>available quantity</td>
                                            <td>reorder level</td>
                                        </tr>
                                    </thead>
                            <tbody>
                                <?php
                                                  
                                  
                                while($stockrow=$stockResult->fetch_assoc()){
                                    
                                              
                                      ?>
                                  
                                
                                <tr>
                                    <td>
                                        <?php
                                        
                                                    
                                                 echo  $stockrow["sku_id"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                                 echo $stockrow["product_name"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $stockrow["size"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $stockrow["colour"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $stockrow["total_quantity"];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $stockrow["reorder_level"];
                                        ?>
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
</html>
<

    