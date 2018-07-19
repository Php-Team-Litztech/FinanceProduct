<?php

include 'db_connect.php';

session_start();

if(isset($_SESSION['empId'])) {
    header("Location: index.php");
}
        
         if (isset($_POST['login'])) {

    echo $empUserName = mysqli_real_escape_string($conn, $_POST['empUserName']);
    echo $password = mysqli_real_escape_string($conn, $_POST['empPassword']);
    $result = mysqli_query($conn, "SELECT * FROM employee_registration WHERE empUserName = '" .$empUserName. "' and empPassword = '" .$password. "' and status = 'unblock' ");

    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['empId'] = $row['empId'];
        $_SESSION['empUserName'] = $row['empUserName'];
        $_SESSION['empBranchName'] = $row['branchName'];
        $_SESSION['empBranchId'] = $row['branchId'];
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>             



     <!-- MENU SECTION END-->
<div class="content-wrapper">
     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Employee Login Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           EMPLOYEE LOGIN FORM
                        </div>
            <div class="panel-body">

            <form action = "" method = "post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Employee User Name</label>
                    <input class="form-control" type="text" name="empUserName" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                    <label>Employee password</label>
                    <input class="form-control" type="password" name="empPassword" id="myInput" required />
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
       
</body>
</html>
