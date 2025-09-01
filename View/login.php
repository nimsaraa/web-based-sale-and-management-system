<!DOCTYPE html>
<html lang="en">
<head>
    <title>A-one</title>
    <?php 
       include_once "../includes/bootstrap_css_includes.php"
    ?>
</head>

<body>
    <div class="container">
        <div class="row" style="height:100px">
        </div>
        <form action="../controller/login_controller.php?status=login" method="post">
            <div class="row">
        <div id="msg" class="col-md-6 col-md-offset-3">
        </div>
        <?php
           if(isset($_GET["msg"])){

        ?>
                      <div class="col-md-6 col-md-offset-3 alert alert-danger">
                        <?php

                        echo base64_decode($_GET["msg"]);
                        ?>
                      </div>

                      <?php
           }
                       ?>              
            </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 panel panel-default" style="height:500px;background-color:#faf5f7; border-radius: 10px; box-shadow: 0 10px 25px  rgb(0 0 0 / 30%);">
                <div class="col-md-6" style="height:450px">
                    
                    <img src="../images/logo.png"  alt="" style="height:450px;margin-top:20px;width:400px; border-radius: 10px;">
                    
                </div>
                <div class="col-md-6"  style="height:450px; ">
                    <div class="row">
                        &nbsp
                    </div>
                    <div class="row">
                        <label class="" style="font-size:30px;font-family:sans-seif; ">Sign in to your account</label>
                    </div>
                    <div class="row">
                        &nbsp
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                           
                                    <div class="row">
                                                 &nbsp
                                    </div>
                            
                                <div class="input-group">
                                      <span class="input-group-addon">
                                                 <span class="glyphicon glyphicon-user"> </span>

                                      </span>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                        </div>
                                    <input type="email" class="form-control" placeholder=" Enter Username"  id="loginusername" name="loginusername" >
                                </div>
                        </div>

                    </div>
                    <div class="row">
                        &nbsp
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="input-group">
                                      <span class="input-group-addon">
                                                 <span class="glyphicon glyphicon-lock"> </span>

                                      </span>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"></span>
                                        </div>
                                    <input type="password" class="form-control" placeholder=" Enter password"  id="loginpassword" name="loginpassword">
                                </div>
                        </div>

                    </div>
                    <div class="row">
                        &nbsp
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2 ">
                            <input type="submit"  name="submit" class="btn btn-primary btn-block" style="">
                        </div>
                    </div>

                </div>
            </div>
      
        </div>
        </form>
    </div>    
</body>
<script src="../JS/jquery-3.7.1.js"></script>
 <script src="../JS/loginvalidations.js"></script> 
</html>