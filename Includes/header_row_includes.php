

<div class="row" style="height:30px"></div>

<div class="row" style="height:120px">
    
    <div class="col-md-3">
        <img src="../images/logo.png" height="120px" width="110px"/>
    </div>
    <div class="col-md-6">
        <h1 align="center">A-One Shoe Store</h1>
    </div>
    <div class="col-md-1 col-md-offset-2">
    </div>
    
</div>

<hr/>


<div class="row">
    
    <div class="col-md-3">
        
            USER :
        
        <?php
        echo ucwords($userrow["user_fname"]." ".$userrow["user_lname"]);
        ?>
    </div>
    <div class="col-md-6">
       
    </div>
    <div class="col-md-1 col-md-offset-2">
        <a href="../controller/login_controller.php?status=logout" class="btn btn-primary">Logout</a>
    </div> 
    
</div>

<hr/>

<div class="row">
    
    <div class="col-md-6 col-md-offset-3">
        <h5 align="center">
            <?php
            echo $pageName;
            ?>
        </h5>
    </div>
    
</div>

