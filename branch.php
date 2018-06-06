<?php
include 'db_connect.php';
session_start();
?>
<?php
         if(isset($_POST['submit'])){

            $companyId = $_SESSION['companyId'];
            $companyName = $_SESSION['companyName'];
            $branch = $_POST['branch'];
            $address = $_POST['address'];
            $no = $_POST['phoneNo'];
           

$sql = "INSERT INTO branch(companyId,companyName,branchName,branchAddress,branchPhoneNo)
VALUES ('$companyId','$companyName','$branch','$address',$no)";

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
    <title>BRANCH</title>
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
            <h4 class="header-line">Branch Registration Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           BRANCH REGISTRATION FORM
                        </div>
            <div class="panel-body">

            <form action = "" method = "post" role="form" >

                <div class="form-group">
                    <label>Branch Name</label>
                    <input class="form-control" type="text" name="branch" required />
                   <!--  <p class="help-block">Help text here.</p> -->
                </div>

                 <div class="form-group">
                    <label>Branch Address</label>
                    <textarea class="form-control" rows="3" name="address" required ></textarea>
                </div>

                <div class="form-group">
                <label>Branch Number</label>
                <div class="input-group">
                <span class="form-group input-group-btn">

                <button class="btn btn-default" type="button">+91</button>
                </span> 
                <input type="number" class="form-control" name="phoneNo" maxlength="10" required>
                </div>
                </div>        
                
                <input type="submit" class="btn btn-info" value="Submit" name="submit">

                    </form>
                </div>
                        </div>
            </div>
        </div>
    </div>
</div>
       

 <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>