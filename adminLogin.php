<?php

include 'db_connect.php';

session_start();

if(isset($_SESSION['companyId'])) {
    header("Location: branch.php");
}
        
         if (isset($_POST['login'])) {

    $companyName = mysqli_real_escape_string($conn, $_POST['companyName']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM admin_registration WHERE companyName = '" . $companyName. "' and password = '" . $password. "'");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['companyId'] = $row['companyId'];
        $_SESSION['companyName'] = $row['companyName'];
        header("Location: index.php");
    } else {
        $errormsg = "Incorrect Company Name or Password!!!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Admin Login</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>             



     <!-- MENU SECTION END-->
<div class="content-wrapper">
     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Admin Login Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           ADMIN LOGIN FORM
                        </div>
            <div class="panel-body">

            <form action = "" method = "post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Company Name</label>
                    <input class="form-control" type="text" name="companyName" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                    <label>Company password</label>
                    <input class="form-control" type="password" name="password" id="myInput" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                     <input type="checkbox" onclick="myFunction()">Show Password
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

<!-- show password -->
<script type="text/javascript">
function myFunction() {
var x = document.getElementById("myInput");
if (x.type === "password") {
x.type = "text";
} else {
x.type = "password";
}
}
</script>
                           
                  
                    <input type="submit" value="Login" class="btn btn-info" name="login">

                    </form>
                    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

                </div>
                        </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
       

 <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
