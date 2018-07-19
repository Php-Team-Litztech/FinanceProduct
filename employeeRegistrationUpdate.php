<?php
include_once 'db_connect.php';
session_start();

if(isset($_GET['edit_id']))
{
	$sql_query="SELECT * FROM employee_registration WHERE empId=".$_GET['edit_id'];
	$result_set=mysqli_query($conn,$sql_query);
	$fetched_row=mysqli_fetch_array($result_set);
}




if(isset($_POST['btn-update']))
{
	// variables for input data
      $empName = $_POST['name'];
      $empUserName = $_POST['userName'];
      $empAddress = $_POST['address'];
      $empPhoneNo = $_POST['phoneNo'];
      $empPassword = $_POST['password'];
      $status = $_POST['status'];;
           
	// variables for input data
	
	// sql query for update data into database
	$sql_query = "UPDATE employee_registration SET empName='$empName',empUserName='$empUserName',empAddress='$empAddress',empPhoneNo= $empPhoneNo ,empPassword='$empPassword',status='$status' WHERE empId=".$_GET['edit_id'];

	// sql query for update data into database
	
	// sql query execution function
	  if (mysqli_query($conn, $sql_query)) {           
    ?>
		<script type="text/javascript">
		alert('Data Are Updated Successfully');
		window.location.href='employeeRegistrationView.php';
		</script>

		<?php
            } 
            else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
}


if(isset($_POST['btn-cancel']))
{
	header("Location: index.php");
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
.disabled {
    opacity: 0.6;
    cursor: not-allowed;
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
                    <input class="form-control" type="text" name="name" value="<?php echo $fetched_row['empName']; ?>" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                    <label>Employee User Name</label>
                    <input class="form-control" value="<?php echo $fetched_row['empUserName']; ?>" type="text" name="userName" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

                <div class="form-group">
                    <label>Employee Address</label>
                    <input class="form-control" value="<?php echo $fetched_row['empAddress']; ?>" type="text" name="address" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>

               <div class="form-group">
                    <label>Employee Phone No</label>
                    <input class="form-control" value="<?php echo $fetched_row['empPhoneNo']; ?>" type="number" name="phoneNo" required />
                    <!-- <p class="help-block">Help text here.</p> -->
                </div>


                <div class="form-group">
                <label>Select status</label>
                <select name="status" class="form-control" id="box1"  required>
                <option value="">None</option>
                <option value="unblock">unblock</option>
                <option value="block">block</option>
                
                </select>
                </div>


                <div class="form-group">
                    <label>Employee password</label>
                    <input class="form-control" type="password" value="<?php echo $fetched_row['empPassword']; ?>" name="password" id="myInput" required />
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

                  
                <input type="submit" class="btn btn-info" value="Update" name="btn-update">
                    
                    </form>
                </div>
                        </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>