<!DOCTYPE html>
<html>
<head>
	<title></title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src=" https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  
<style type="text/css">

	th { white-space: nowrap; }

</style>

</head>
<body>

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


<div class="container">                            
  <div class="table-responsive">          
  <table class="table"  id="example" class="display" style="width:100%">
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


</body>
</html>