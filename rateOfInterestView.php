<?php
include_once 'db_connect.php';
session_start();

if(isset($_POST['get_option']))
{
 $state = $_POST['get_option'];
 $find=mysqli_query($conn,"select * from rate_of_interest where companyId LIKE {$_SESSION['companyId']} AND branchName='$state'");
 while($row=mysqli_fetch_array($find))
 {
  echo "<option value=".$row['interestId'].">".$row['interestRate']."</option>";
 }
 exit;
}


if(isset($_POST['select_name'])){ // select_name will be replaced with your input filed name
    $getInput = $_POST['select_name']; // select_name will be replaced with your input filed name
    $selectedOption = "";
    foreach ($getInput as $option => $value) {

        $selectedOption .= $value.','; // I am separating Values with a comma (,) so that I can extract data using explode()aa
        $q5 = explode(",", $selectedOption);
}

for($i=0; $i<sizeof($q5); $i++){

         $sql_query = "DELETE FROM rate_of_interest  WHERE interestId = $q5[$i]";

          if (mysqli_query($conn, $sql_query)) {
             /*  echo "New record created successfully";
*/
               ?>
        <script type="text/javascript">
        alert('Data Are Remove Successfully');
        window.location.href='index.php';
        </script>

        <?php
            } else {
               echo "Error: " . $sql_query . "" . mysqli_error($conn);
            }
            
    }
    echo $selectedOption; 
}

?>
<!DOCTYPE html>
<html lang="en">
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

.row{
margin-top:40px;
padding: 0 10px;
}
.clickable{
cursor: pointer;   
}

.panel-heading div {
margin-top: -18px;
font-size: 15px;
}
.panel-heading div span{
margin-left:5px;
}
.panel-body{
display: none;
}

</style> 
  
</head>
<body>
<?php include 'header.php'; ?>


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

            <form action = "" method = "post" role="form">

                    <div class="form-group" id="select_box">
                    <label for="sel1">Select list (select one):</label>
                    <select class="form-control" id="sel1" onchange="fetch_select(this.value);">
                    <option value="">None</option>
                    <?php

                    $select=mysqli_query($conn,"select branchName from branch  WHERE companyId LIKE {$_SESSION['companyId']} AND status = 'unblock' group by branchName");
                    while($row=mysqli_fetch_array($select))
                    {
                    echo "<option>".$row['branchName']."</option>";
                    }
                    ?>
                    </select>
                    </div>
                    
                    <div class="form-group">
                    <label for="sel2">Mutiple select Rate Of Interest</label>
                    <select multiple class="form-control" name="select_name[]" id="new_select">

                    </select>
                    </div>            

                    <input type="submit" class="btn btn-info" value="Remove" name="btn-update">

                    </form>
                </div>
            </div>
        </div>
 </div>
</div>


<!-- for dynamicaly select the text box -->

<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'rateOfInterestView.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}

</script>

</body>
</html>





