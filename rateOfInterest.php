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
            $roi = $_POST['roi'];
            
           

$sql = "INSERT INTO rate_of_interest(companyId,companyName,branchId,branchName,interestRate)
VALUES ('$companyId','$companyName','$branchId','$branchName',$roi)";

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
            <h4 class="header-line">Rate Of Interest Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           Rate Of Interest FORM
                        </div>
            <div class="panel-body">

            <form action = "" method = "post" role="form">

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
                <label>Rate Of Interest</label>
                <div class="input-group">
                <input type="number" class="form-control" name="roi" required>
                <span class="input-group-addon" id="basic-addon2">%</span>
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

<?php
include 'footer.php';
?>

       

 <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
