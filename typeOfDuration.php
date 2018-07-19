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
            $durationType = $_POST['duration'];
            
           

$sql = "INSERT INTO type_of_duration(companyId,companyName,branchId,branchName,durationType)
VALUES ('$companyId','$companyName','$branchId','$branchName','$durationType')";

            if (mysqli_query($conn, $sql)) {
              /* echo "New record created successfully";*/
               ?>
       <!--  <script type="text/javascript">
        alert('Data Are Updated Successfully');
        window.location.href='index.php';
        </script> -->

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

</head>
<body>
    
<?php
include 'header.php';
?>


  
<div class="content-wrapper">
     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Type Of Duration Form</h4>
        </div>

</div>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           Type Of Duration FORM
                        </div>
            <div class="panel-body">

            <form action = "" method = "post" role="form">

                <div class="form-group">
                <label>Select Branch</label>
                <select name="branch" class="form-control" id="box1" onChange="getSelectedText(this);"  required>
                <option value="">None</option>

                <?php
                $query ="SELECT branchName, branchId FROM branch WHERE  companyId LIKE {$_SESSION['companyId']} AND status = 'unblock' Group by branchName  ";
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
                    <label>Type Of Duration</label>
                    <input class="form-control" type="text" name="duration" required />
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

       
</body>
</html>
