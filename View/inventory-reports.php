<?php

include_once '../commons/session.php';
include_once '../Model/inventory_model.php';

$userrow = $_SESSION["user"];

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
            $pageName = "INVENTORY REPORTS"
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
                <div>
                     


                    
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="reorder-products-report.php">
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;
                                    reorder products report
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary" style="height:40px;">
                            <div class="text-center">
                                <a href="reorder-raw-report.php">
                                    <span class="glyphicon glyphicon-list"></span> &nbsp;
                                    reorder raw items report
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
    </body>
</html>

