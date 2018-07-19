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
            $status = 'unblock';
           

$sql = "INSERT INTO branch(companyId,companyName,branchName,branchAddress,branchPhoneNo,status)
VALUES ('$companyId','$companyName','$branch','$address',$no,'$status')";

            if (mysqli_query($conn, $sql)) {
              /* echo "New record created successfully";*/
               ?>
    <script type="text/javascript">
    alert('Data Are Inserted Successfully ');
    window.location.href='index.php';
    </script>
    <?php
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
         }
      ?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style type="text/css">

body {
    font-family: 'Open Sans', sans-serif;
    line-height:28px;
   
}

        .menu-section {
    background-color: #f7f7f7;
    border-bottom: 5px solid #9170E4;
    width: 100%;
}



</style>
<script type="text/javascript">
    $(document).ready(function(){
    // Initialize Tooltip
    $('[data-toggle="tooltip"]').tooltip(); 
})
</script>

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


</body>
</html>
