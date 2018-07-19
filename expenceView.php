<?php
include_once 'db_connect.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>



  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>




<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>





<style type="text/css">


    th { 
        white-space: nowrap;
        background-color: #337ab7;
         }


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
<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                '$'+pageTotal +' ( $'+ total +' total)'
            );
        }
    } );
} );


</script>
  
</head>
<body>

    <?php include 'header.php'; ?>



<div class="container">                            
  <div class="table-responsive">          
  <table   id="example" class="table" style="width:100%" class="display nowrap" >
    <thead>
      <tr>
        <th>#</th>
        <th>Branch Name</th>
        <th>Expence For</th>
        <th>Expence Date</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
<?php

$sql = "SELECT * FROM `expenses` WHERE companyId =".$_SESSION['companyId'];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {

?>
<tr>
<td><?php echo $row["expensesId"]; ?></td>
<td><?php echo $row["branchName"]; ?></td>
<td><?php echo $row["expensesFor"]; ?></td>

<td><?php 
$date_from_db = $row["expensesDate"];
$timestamp = strtotime($date_from_db);
echo date('d/m/Y', $timestamp);
?>
</td>

<td id="td"><?php echo $row["expensesAmount"]; ?></td>

</tr>

<?php

}
}
?>
    </tbody>
     <tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
  </table>
  </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

</body>
</html>
