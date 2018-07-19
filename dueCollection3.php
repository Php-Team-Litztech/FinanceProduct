<?php
include_once 'db_connect.php';
session_start();

/* get id from dueCollection1 and view data */

if(isset($_GET['edit_id']))
{
   $transitionIdform = $_GET['edit_id'];

  $sql_query="SELECT * FROM history WHERE transitionId= $transitionIdform ";
  $result1=mysqli_query($conn,$sql_query);

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


<!-- table view of all data -->

<div class="container">
    <div class="row">
        <h2 class="text-center">Due Transition Report </h2>
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
              </tr>
            </thead>
            <tbody>
<?php
if ($result1->num_rows > 0) {

while($res = $result1->fetch_assoc()) {
?>

<tr>
<td><?php echo $res['dueId'];?>
<td><?php echo $res['dueDate'];?>
<td><?php echo $res['paidDate'];?>
<td><?php echo $res['FineAmount'];?>
<td><?php echo $res['dueAmount'];?>
<td><?php echo $res['paidAmount'];?>
<td><?php echo $res['amountReceiver'];?>
<td><?php echo $res['status'];?>
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


<!-- <div class="container">
        <div class="row">
        <h2 class="text-center">total Amount = </h2>
        </div>
    </div> -->

<?php
include 'footer.php';
?>
</body>
</html>