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
    <title>Admin Registration</title>
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
            <h4 class="header-line">Admin Registration Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           ADMIN REGISTRATION FORM
                        </div>
            <div class="panel-body">

            <form action = "" method = "post" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Company Name</label>
                    <input class="form-control" type="text" name="name" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                 <div class="form-group">
                    <label>Company Address</label>
                    <textarea class="form-control" rows="3" name="address" required ></textarea>
                </div>

                <div class="form-group">
                <label>Company Number</label>
                <div class="input-group">
                <span class="form-group input-group-btn">

                <button class="btn btn-default" type="button">+91</button>
                </span>
                <input type="number" class="form-control" name="no" maxlength="10" required>
                </div>
                </div>

                <div class="form-group">
                    <label>Company Logo (Size max 4MB)</label>
                    <input class="form-control" type="file" name="logo" id="fileChooser" onchange="return ValidateFileUpload()" required/>
                </div>

                <SCRIPT type="text/javascript">
    function ValidateFileUpload() {
        var fuData = document.getElementById('fileChooser');
        var FileUploadPath = fuData.value;

//To check if user upload any file
        if (FileUploadPath == '') {
            alert("Please upload an image");

        } else {
            var Extension = FileUploadPath.substring(
                    FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

//The file uploaded is an image

if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                    || Extension == "jpeg" || Extension == "jpg") {

// To Display
                if (fuData.files && fuData.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }

            } 

//The file upload is NOT an image
else {
                alert("Photo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");

            }
        }
    }
</SCRIPT>

                <img src="images/noimg.jpg" id="blah" width="200px" height="100px">
                <br><br>
                <div class="form-group">
                    <label>Company Registration Date</label>
                    <input class="form-control" type="date" name="regDate" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                    <label>Company Software Expiry Date</label>
                    <input class="form-control" type="date" name="expDate" required />
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
                           
                  
                    <input type="submit" value="Submit" class="btn btn-info" name="submit">

                    </form>
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
