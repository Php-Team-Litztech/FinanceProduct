<?php
include 'db_connect.php';
?>
<?php
         if(isset($_POST['submit'])){

            $name = $_POST['name'];
            $address = $_POST['address'];
            $no = $_POST['no'];
            $logo = addslashes(file_get_contents($_FILES['logo']['tmp_name']));
            $regDate = $_POST['regDate'];
            $expDate = $_POST['expDate'];
            $status = 'Unblock';
            $password = $_POST['password'];

$sql = "INSERT INTO admin_registration(companyName,companyAddress,companyPhoneNo,companyLogo,dateOfRegistration,expiryDate,status,password)

VALUES ('$name','$address',$no,'{$logo}','$regDate','$expDate','$status','$password')";

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

    <?php include 'header.php'; ?>    


     <!-- MENU SECTION END-->
<div class="content-wrapper">
     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Customer Proof Form</h4>
        </div>
</div>



<div class="row">
    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>
    <div class="col-md-8">
<form role="form">
         <div class="col-md-6">   
        <div class="form-group">
        <label>Customer Number (OR)</label>
        <input class="form-control" type="number" required />
        </div>
        </div>
        
        <div class="col-md-6">
       <!--  <h4>[OR]</h4> -->
        <div class="form-group">
        <label>Customer Name</label>
        <input class="form-control" type="text" required />
        </div>
        </div>
        <br>
        <div class="col-md-12">
        <button type="submit" class="btn btn-info  btn-block">Submit</button>
        </div>
        </div>
        </div>

        

</form>

</div>

<br><br>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           Customer Proof
                        </div>
            <div class="panel-body">

            <form role="form">

                <div class="form-group">
                    <label>Customer Name (auto)</label>
                    <input class="form-control" type="text" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                    <label>Customer Phone no (auto)</label>
                    <input class="form-control" type="text" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                 <div class="form-group">
                    <label>Customer Address (auto)</label>
                    <textarea class="form-control" rows="3" required ></textarea>
                </div>


                <div class="form-group">
                    <label>1 Proof Name</label>
                    <input class="form-control" type="text" required />
                </div>

                <div class="form-group">
                    <label>1 Upload Proof</label>
                    <input class="form-control" type="file" required />
                </div>

                <div class="form-group">
                    <label>2 Proof Name</label>
                    <input class="form-control" type="text" required />
                </div>

                <div class="form-group">
                    <label>2 Upload Proof</label>
                    <input class="form-control" type="file" required />
                </div>

                <div class="form-group">
                    <label>3 Proof Name</label>
                    <input class="form-control" type="text" required />
                </div>

                <div class="form-group">
                    <label>3 Upload Proof</label>
                    <input class="form-control" type="file" required />
                </div>

                <div class="form-group">
                    <label>4 Proof Name</label>
                    <input class="form-control" type="text" required />
                </div>

                <div class="form-group">
                    <label>4 Upload Proof</label>
                    <input class="form-control" type="file" required />
                </div>

                
                
                 
                 
                    <button type="submit" class="btn btn-info">Submit</button>

                    </form>
                </div>
                        </div>
            </div>
        </div>
    </div>
</div>

     <!-- CONTENT-WRAPPER SECTION END-->
    <section class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   &copy; 2014 Yourdomain.com |<a href="http://www.binarytheme.com/" target="_blank"  > Designed by : binarytheme.com</a> 
                </div>

            </div>
        </div>
    </section>
       

 <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
