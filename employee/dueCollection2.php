<?php
include_once 'db_connect.php';
session_start();

/* get id from dueCollection1 and view data */

if(isset($_GET['edit_id']))
{
   $transitionIdform = $_GET['edit_id'];

  $sql_query="SELECT * FROM due WHERE transitionId= $transitionIdform ";
  $result=mysqli_query($conn,$sql_query);
  $result1=mysqli_query($conn,$sql_query);
  $result2=mysqli_query($conn,$sql_query);
  $result4=mysqli_query($conn,$sql_query);

  $sql="SELECT * FROM new_transition WHERE transitionId = $transitionIdform ";
  $result_set=mysqli_query($conn,$sql);
  $updateButton=mysqli_query($conn,$sql);
  $fetched_row=mysqli_fetch_array($result_set);
  $result3=mysqli_query($conn,$sql);


}

// for due Continue

if(isset($_POST['DueContinue']))
{ 

    while($res = $result3->fetch_assoc()) {
      echo $duration = $res['transitionType'];
   }

    while($res1 = $result4->fetch_assoc()) {
        $Date = $res1['dueDate'];
        $companyId = $res1['companyId'];
        $companyName = $res1['companyName'];
        $branchId = $res1['branchId'];
        $branchName = $res1['branchName'];
        $transitionIdform = $res1['transitionId'];
        $interestAmount = $res1['interestAmount'];
        $totalAmount = $res1['totalAmount'];
        $dueDate = $res1['dueDate'];
        $dueAmount = $res1['dueAmount'];
        $dueId = $res1['dueId'];
        $paidDate = date('Y-m-d');
        $paidAmount = $res1['interestAmount'];
        $fineAmount = $res1['fineAmount'];
        $balanceAmount = $res1['balanceAmount'];
     }

$status = 'completed';
$companyId = $_SESSION['companyId'];   
if($companyId != '')
{
 $amountReceiver = 'Admin,'.$_SESSION['companyId'];
}else{
 $amountReceiver = 'Employee,'.$_SESSION['empId'];
}


if($duration == 'Ten Days'){
  echo $date = date('Y-m-d', strtotime($Date. ' + 10 days'));
} else if($duration == 'one mounth'){
  echo $date = date('Y-m-d', strtotime($Date. ' +1 month'));
}



    $sql_query1 = "UPDATE due SET status='Pending', dueDate = '$date' , paidAmount = '0' , paidDate = '0' WHERE transitionId = '$transitionIdform'";
    if (mysqli_query($conn, $sql_query1)) {
    } else {
       echo "Error: " . $sql_query . "" . mysqli_error($conn);
    }

// for insert in to history table
$insertQuery = "INSERT INTO history (companyId, companyName, branchId, branchName, dueId ,
transitionId, dueDate, dueAmount, interestAmount,fineAmount, totalAmount, paidDate, 
paidAmount, balanceAmount, amountReceiver, status) 
VALUES ('$companyId', '$companyName', '$branchId', '$branchName', '$dueId', '$transitionIdform',
'$dueDate', '$dueAmount', '$interestAmount', '$fineAmount', '$totalAmount',
'$paidDate', '$paidAmount', '$balanceAmount','$amountReceiver','$status')";

if (mysqli_query($conn, $insertQuery)) {
      header("Location: dueCollection2.php?edit_id=".$transitionIdform);
} else {
echo "Error: " . $insertQuery . "" . mysqli_error($conn);
}
}



/*for all due commplete*/
if(isset($_POST['Due_completed']))
{ 
   $sql_query = "UPDATE new_transition SET status='Completed' WHERE transitionId = '$transitionIdform'";
    if (mysqli_query($conn, $sql_query)) {
    ?>
    <script type="text/javascript">
      alert('This transition is finished');
    window.location.href='index.php';
    </script>
    <?php
            } else {
               echo "Error: " . $sql_query . "" . mysqli_error($conn);
            }
   }

/*for due update*/

if(isset($_POST['btn-update']))
{

  // new variable for history Info
  $companyId = $_POST['companyId'];
  $companyName = $_POST['companyName'];  
  $branchId = $_POST['branchId'];
  $branchName = $_POST['branchName'];
  $transitionIdform = $_POST['transitionId'];
  $interestAmount = $_POST['interestAmount'];
  $totalAmount = $_POST['totalAmount'];

  $dueDate = $_POST['dueDate'];
  $dueAmount = $_POST['dueAmount']; 


  // variables for input data
   $dueId = $_POST['dueId'];
   $paidDate = date('Y-m-d');
   $paidAmount = $_POST['paidAmount'];
   $fineAmount = $_POST['fineAmount'];
   $balanceAmount = $_POST['balanceAmount'];
   $companyId = $_SESSION['companyId'];

if($companyId != '')
{
 $amountReceiver = 'Admin,'.$_SESSION['companyId'];
}else{
 $amountReceiver = 'Employee,'.$_SESSION['empId'];
}

if ($balanceAmount == '0') {
  $status = 'completed';
}else{
  $status = 'pending';
}


  // variables for input data
  
  // sql query for update data into database

$sql_query = "UPDATE due SET paidDate = '$paidDate', paidAmount='$paidAmount',balanceAmount='$balanceAmount' ,amountReceiver='$amountReceiver',status='$status' WHERE dueId='$dueId'";
    if (mysqli_query($conn, $sql_query)) {
   
            } else {
               echo "Error: " . $sql_query . "" . mysqli_error($conn);
            }

            // for insert in to history table

            $insertQuery = "INSERT INTO history (companyId, companyName, branchId, branchName, dueId ,
            transitionId, dueDate, dueAmount, interestAmount,fineAmount, totalAmount, paidDate, 
            paidAmount, balanceAmount, amountReceiver, status) VALUES ('$companyId', '$companyName', '$branchId', '$branchName', '$dueId', '$transitionIdform',
            '$dueDate', '$dueAmount', '$interestAmount', '$fineAmount', '$totalAmount',
            '$paidDate', '$paidAmount', '$balanceAmount','$amountReceiver','$status')";

            if (mysqli_query($conn, $insertQuery)) {
                  header("Location: dueCollection2.php?edit_id=".$transitionIdform);
            } else {
            echo "Error: " . $insertQuery . "" . mysqli_error($conn);
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

              input.hidden {
    position: absolute;
    left: -9999px;
}

#profile-image1 {
    cursor: pointer;
  
     width: 100px;
    height: 100px;
  border:2px solid #03b1ce ;}
  .tital{ font-size:16px; font-weight:500;}
   .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}  


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

<!-- user Info -->

<div class="container">
  <div class="row">       
      <div class="col-md-3 ">
      </div> 
       <div class="col-md-7 ">

<div class="panel panel-default">
  <div class="panel-heading">
    <h4 >User Profile</h4></div>
   <div class="panel-body">
       
    <div class="box box-info">
        



<div class="box-body">
<div class="col-sm-6">
<div  align="center"> 
<img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
<input id="profile-image-upload" class="hidden" type="file">              
</div>             
<br>

</div>
<div class="col-sm-6">
<h4 style="color:#00b1b1;"><?php echo $fetched_row['cusName']; ?></h4></span>
<span><p><?php echo $fetched_row['branchName']; ?></p></span>            
</div>
<div class="clearfix"></div>
<hr style="margin:5px 0 5px 0;">

              
<div class="col-sm-5 col-xs-6 tital " >First Name:</div><div class="col-sm-7 col-xs-6 "><?php echo $fetched_row['cusName']; ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Phone No:</div><div class="col-sm-7"> <?php echo $fetched_row['cusPhoneNo']; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Address:</div><div class="col-sm-7"><?php echo $fetched_row['cusAddress']; ?></div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Intial Amount:</div><div class="col-sm-7"><?php echo $fetched_row['initialAmount']; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Rate Of Interest:</div><div class="col-sm-7"><?php echo $fetched_row['rateOfInterest']; ?></div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Total Amount:</div><div class="col-sm-7"><?php echo $fetched_row['totalAmount']; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Branch:</div><div class="col-sm-7"><?php echo $fetched_row['branchName']; ?></div>

 <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Fine Amount Per Day:</div><div class="col-sm-7"><?php echo $fetched_row['fineAmount']; ?></div>
          </div>
        </div>   
    </div> 
    </div>
</div>  
</div>


<!-- update due info -->

<div class="container">
    <div class="row">
        <h2 class="text-center">Due Information</h2>
        <div class="table-responsive">          
            <table class="table table-bordered table-hover">
            <thead>
              <tr>        
                <th>Due Id</th>
                <th>Due Date</th>
                <th>Paid Date</th>
                <th>Fine Amt</th>
                <th>Due Amt</th>
                <th>Total Amt</th> 
                <th>Balance Amt</th>
                <th>Paid Amt</th>
                <th>Update</th>              
              </tr>
            </thead>
            <tbody>

<?php
if ($result->num_rows > 0) {

while($res = $result->fetch_assoc()) {

if ($res['status'] != 'completed') {
?>
<tr>

<form name="myform" action = "dueCollection2.php" method = "post" role="form">
<td><?php echo $res['dueId'];?>
  <input type="hidden" id="dueId" name="dueId" value="<?php echo $res["dueId"]; ?>">

  <!--  for info store in history -->
  <input type="hidden" name="companyId" value="<?php echo $res["companyId"]; ?>">
  <input type="hidden" name="companyName" value="<?php echo $res["companyName"]; ?>">
  <input type="hidden" name="branchId" value="<?php echo $res["branchId"]; ?>">
  <input type="hidden" name="branchName" value="<?php echo $res["branchName"]; ?>">
  <input type="hidden" name="transitionId" value="<?php echo $res["transitionId"]; ?>">
  <input type="hidden" name="dueDate" value="<?php echo $res["dueDate"]; ?>">
  <input type="hidden" name="interestAmount" value="<?php echo $res["interestAmount"]; ?>">
  <input type="hidden" name="totalAmount" value="<?php echo $res["totalAmount"]; ?>">

</td>

<td>
  <?php 

$date_from_db = $res["dueDate"];
$timestamp = strtotime($date_from_db);
echo date('d/m/Y', $timestamp);

?>

<input type="hidden" id="dueDate" value="<?php echo $res["dueDate"]; ?>">
</td>

<td>
  <input id="paidDate" name="paidDate" type="date" value="<?php echo date('Y-m-d'); ?>"   required>
</td>


<td>
<input disabled id="fineAmount" name="fineAmount" type="number"  onchange="fineReduce()" required>
<input type="hidden" id="fine" value="<?php echo $res["fineAmount"]; ?>" >
</td>

<td>
  <?php echo $res["dueAmount"]; ?>
  <input type="hidden" id="dueAmount" name="dueAmount" value="<?php echo $res["dueAmount"]; ?>">
</td>

<td><input  type="text" id="total" value="<?php echo $res["dueAmount"]; ?>" readonly></td>

<td>
<input type="text" id="bal" name="balanceAmount"  value="<?php echo $res["balanceAmount"]; ?>" readonly>
<input type="text" id="bal1"  value="<?php echo $res["balanceAmount"]; ?>" hidden>
</td>


<td>
  <input disabled id="paidAmount" name="paidAmount" type="number" required>
</td>

<td>
  <button type="button"  class="btn btn-primary" onclick="paid()">confirm your payment</button>
  <br><br>
  <input disabled type="submit" class="btn btn-info" value="Submit" name="btn-update" id="submit">
</td>
</form>
</tr>


<?php
break;
}

}
}

?>

<script type="text/javascript">

document.getElementById("fineAmount").disabled = false;
document.getElementById("paidAmount").disabled = false;
document.getElementById("paidDate").disabled = true;


var paidDate = new Date(document.getElementById("paidDate").value);
var dueDate = new Date(document.getElementById("dueDate").value);


if (paidDate.getTime() > dueDate.getTime() ) {

var timeDiff = Math.abs(paidDate.getTime() - dueDate.getTime());
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
var dueDate = parseInt(document.getElementById("fine").value);

var fine =  diffDays*dueDate;
document.getElementById("fineAmount").value = (fine);


var total = parseInt(document.getElementById("total").value);
var bal = parseInt(document.getElementById("bal").value);

document.getElementById("total").value = (fine + total);
document.getElementById("bal").value = (fine + bal);
}
else{
  document.getElementById("fineAmount").disabled = true;
}


function fineReduce() {

var fine = parseInt(document.getElementById("fineAmount").value);
var total = parseInt(document.getElementById("dueAmount").value);

var totalBal = parseInt(document.getElementById("bal1").value);

document.getElementById("total").value = (total + fine);
document.getElementById("bal").value = (totalBal + fine);

}


function paid() {

var paidAmount = parseInt(document.getElementById("paidAmount").value);
var total = parseInt(document.getElementById("bal").value);
var transTyep = ("trans - type");
if(transTyep == 'Ten Days' || 'One Month'){
  document.getElementById("bal").value = total;
} else {
  document.getElementById("bal").value = (total - paidAmount);
}
document.getElementById("submit").disabled = false;
}

</script>

            </tbody>
          </table>
        </div>
      </div>
    </div>



<br><br>
<br>


                 <div class="row">
<script>
function ShowMessage() {
var result = confirm("Do your want to Completed This Transition?");
if (result) {
return true;
} else {
return false;
}
} 
</script>



<form method="post" action="">

<?php
  $number = $result2->num_rows;
  if ($result2->num_rows == $number) {
    $items = array();
    $count = 0;
    while($res = $result2->fetch_assoc()) {
     $items[$count++] = $res['status'] ;
   }
   $items; 
   $status_J = end($items);
   if ($status_J == 'completed') {
     end($items);
     ?>
<input type="submit" value="Completed" name="Due_completed" id="passed" onclick="javascript:return ShowMessage();" class="btn btn-info btn-lg btn-block" >
  <?php
  }
  else{
  }
}
?>

</form>
<br>

<!-- for update new due for ten , mounth -->

<form method="post" action="">
<?php

while($res = $updateButton->fetch_assoc()) {
       $Update = $res['transitionType'] ; 
       $interest = $res['interestAmount'] ; 
}
   if ($Update == 'Ten Days' OR $Update == 'one mounth') {
     ?>
<input type="submit" value="Due Continue and Collection ROT Of RS:- <?php echo $interest; ?> " name="DueContinue" id="DueContinue" onclick="javascript:return Show();" class="btn btn-info btn-lg btn-block" >
  <?php
  }
  else{
  }

?>
</form>
<br>

<script>
function ShowMessage() {
var result = confirm("Do your want to Continue This Transition?");
if (result) {
return true;
} else {
return false;
}
} 
</script>

</div><br><br>

<!-- table view of all data -->

<div class="container">
    <div class="row">
        <h2 class="text-center">Due Transition Information </h2>
        <div class="table-responsive">          
            <table class="table table-bordered table-hover">
            <thead>
              <tr>        
                <th>Due Id</th>
                <th>Due Date</th>
                <th>Paid Date</th>
                <th>Fine Amt</th>
                <th>Due Amt</th>
                <th>paid Amt</th> 
                <th>Amt Receiver</th>
                <th>Status</th> 
                <th>Report</th>           
              </tr>
            </thead>
            <tbody>
<?php
if ($result1->num_rows > 0) {

while($res = $result1->fetch_assoc())

 {
?>

<tr>
<td><?php echo $res['dueId'];?>
<td><?php echo $res['dueDate'];?>
<td><?php echo $res['paidDate'];?>
<td><?php echo $res['fineAmount'];?>
<td><?php echo $res['dueAmount'];?>
<td><?php echo $res['paidAmount'];?>
<td><?php echo $res['amountReceiver'];?>
<td><?php echo $res['status'];?>
<td><a href="javascript:edt_id('<?php echo $res['transitionId']; ?>')">
  <button type="button" class="btn btn-info btn-lg btn-block">Report</button>
  </a></td>

  </tr>


<?php
}
}
?>

            </tbody>
          </table>
        </div>
      </div>
    </div>

<script type="text/javascript">
  function edt_id(id)
{
    if(confirm('Sure to go with this Transition ?'))
    {
        window.location.href='dueCollection3.php?edit_id='+id;
    }else{
        alert("0");
    }
}
</script>

<?php
include 'footer.php';
?>
</body>
</html>