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
<script type="text/javascript">
(function(){
    'use strict';
    var $ = jQuery;
    $.fn.extend({
        filterTable: function(){
            return this.each(function(){
                $(this).on('keyup', function(e){
                    $('.filterTable_no_results').remove();
                    var $this = $(this), 
                        search = $this.val().toLowerCase(), 
                        target = $this.attr('data-filters'), 
                        $target = $(target), 
                        $rows = $target.find('tbody tr');
                        
                    if(search == '') {
                        $rows.show(); 
                    } else {
                        $rows.each(function(){
                            var $this = $(this);
                            $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                        })
                        if($target.find('tbody tr:visible').size() === 0) {
                            var col_count = $target.find('tr').first().find('td').size();
                            var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
                            $target.find('tbody').append(no_results);
                        }
                    }
                });
            });
        }
    });
    $('[data-action="filter"]').filterTable();
})(jQuery);


$(function(){
    // attach table filter plugin to inputs
    $('[data-action="filter"]').filterTable();
    
    $('.container').on('click', '.panel-heading span.filter', function(e){
        var $this = $(this), 
            $panel = $this.parents('.panel');
        
        $panel.find('.panel-body').slideToggle();
        if($this.css('display') != 'none') {
            $panel.find('.panel-body input').focus();
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
})


/*end of filter*/

// edit 

function edt_id(id)
{
    if(confirm('Sure to go with this Transition ?'))
    {
        window.location.href='dueCollection2.php?edit_id='+id;
    }else{
        alert("0");
    }
}




</script>
  
</head>
<body>

    <?php include 'header.php'; ?>


<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Developers</h3>
                        <div class="pull-right">
                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                <i class="glyphicon glyphicon-filter"></i>
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <input type="date" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Filter Developers" />
                    </div>
                    <div class="table-responsive">
                    <table class="table table-hover" id="dev-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Customer Name</th>
                                <th>Customer Phone NO</th>
                                <th>Customer Address</th>
                                <th>Transition Type</th>
                                <th>Intial Amount</th>
                                <th>Start Date</th>
                                <th>Due Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $date = date('Y-m-d');

$sql="SELECT * FROM new_transition WHERE transitionId IN (SELECT transitionId FROM due WHERE status = 'Pending' AND dueDate < '$date') ";


                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while($row = $result->fetch_assoc()) {

                                    ?>
                                    <tr>
                                        <td><?php echo $row['transitionId'];?></td>
                                        <td><?php echo $row["branchName"]; ?></td>
                                        <td><?php echo $row["cusName"]; ?></td>
                                        <td><?php echo $row["cusPhoneNo"]; ?></td>
                                        <td><?php echo $row["cusAddress"]; ?></td>
                                        <td><?php echo $row["transitionType"]; ?></td>
                                        <td><?php echo $row["initialAmount"]; ?></td>
                                        <td><?php echo $row["startingDate"]; ?></td>
                                        <td><?php echo $row["noOfCount"]; ?></td>
                                        <td><a href="javascript:edt_id('<?php echo $row['transitionId']; ?>')"><button type="button" class="btn btn-primary">GO!..</button></a></td>
                        
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
        </div>
    </div>


</body>
</html>
