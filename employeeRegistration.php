<?php
include 'db_connect.php';
session_start();
?>
<?php

         if(isset($_POST['submit'])){

            $companyId = $_SESSION['companyId'];
            $companyName = $_SESSION['companyName'];
            $branchId = $_POST['branch'];
            $branchName = $_POST['selectBranchName'];
            $empName = $_POST['name'];
            $empUserName = $_POST['userName'];
            $empAddress = $_POST['address'];
            $empPhoneNo = $_POST['phoneNo'];
            $empPassword = $_POST['password'];
            $status = 'Unblock';
           
           

$sql = "INSERT INTO employee_registration(companyId,companyName,branchId,branchName,empName,empUserName,empAddress,empPhoneNo,empPassword,status)
VALUES ('$companyId','$companyName','$branchId','$branchName','$empName','$empUserName','$empAddress','$empPhoneNo','$empPassword','$status')";

            if (mysqli_query($conn, $sql)) {
               echo "New record created successfully";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
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
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
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
    <?php 

include 'header.php';

    ?>

     <!-- MENU SECTION END-->
<div class="content-wrapper">
     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Employee Registration Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           EMPLOYEE REGISTRATION FORM
                        </div>
            <div class="panel-body">

            <form  action = "" method = "post" role="form">

                <div class="form-group">
                    <label>Employee Name</label>
                    <input class="form-control" type="text" name="name" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>
                <div class="form-group">
                    <label>Employee User Name</label>
                    <input class="form-control" type="text" name="userName" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                 <div class="form-group">
                    <label>Employee Address</label>
                    <textarea class="form-control" rows="3" name="address" required ></textarea>
                </div>

               <div class="form-group">
                <label>Select Branch</label>
                <select name="branch" class="form-control" id="box1" onChange="getSelectedText(this);"  required>
                <option value="">None</option>

                <?php
                $query ="SELECT branchName, branchId FROM branch WHERE companyId LIKE {$_SESSION['companyId']} Group by branchName  ";
                $result= mysqli_query($conn,$query);

                while($row=mysqli_fetch_array($result))
                {    

                echo '<option value="'.$row['branchId'].'">'.$row['branchName'].'</option>';
                
                }
                ?>
                </select>
                <input type="hidden" name="selectBranchName" id="selectBranchName_hidden">
                </div>

<script>
function getSelectedText(sel)
{
var getText = (sel.options[sel.selectedIndex].text);
document.getElementById("selectBranchName_hidden").value = getText;
//$("#selectBranchName_hidden").val(("#box1").find(":selected").text());
//alert(getText);
}
</script>

                <div class="form-group">
                <label>Employee Number</label>
                <div class="input-group">
                <span class="form-group input-group-btn">
                <button class="btn btn-default" type="button">+91</button>
                </span>
                <input type="number" class="form-control" name="phoneNo" maxlength="10" required>
                </div>
                </div>
                <div class="form-group">
                    <label>Employee password</label>
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

                  
                <input type="submit" class="btn btn-info" value="Submit" name="submit">
                    
                    </form>
                </div>
                        </div>
            </div>
        </div>
    </div>
</div>



<!-- footer  -->
<?php
//include 'footer.php';
?>     

 <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
