<?php
include 'db_connect.php';
session_start();

/*echo date('Y-m-d');*/

?>


<!DOCTYPE html>
<html>
<head>
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

    <?php include 'header.php'; ?>     


    <!-- MENU SECTION END-->
    <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Customer Due Collection Form</h4>
            </div>
        </div>



        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
            </div>
            <div class="col-md-8">

              <form action = "dueCollection1.php" method = "post" role="form" >
                   <div class="col-md-6">   
                    <div class="form-group">
                        <label>Customer Number</label>
                        <input class="form-control" type="number" name="number" required/>
                    </div>
                </div>

                    <div class="col-md-6">
                     <div class="form-group">
                    <label>Select Branch</label>
                    <select name="branch" id="branch" class="form-control" id="box1" onChange="getSelectedText(this);" required >
                        <option value="">None</option>

                        <?php
                        $query ="SELECT branchName, branchId FROM branch WHERE companyId LIKE {$_SESSION['companyId']} AND status = 'unblock' Group by branchName  ";
                        $result= mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($result))
                        {    
                            echo '<option value="'.$row['branchId'].'">'.$row['branchName'].'</option>';
                        }
                        ?>
                    </select>
                    <input type="hidden" name="selectBranchName" id="selectBranchName_hidden">
                </div>
              </div>

<!-- for get the text of selected drop down -->
<script>
function getSelectedText(sel)
{
var getText = (sel.options[sel.selectedIndex].text);
document.getElementById("selectBranchName_hidden").value = getText;
}
</script>

                <br>
                <div class="col-md-12">
                   <input type="submit" value="Submit" class="btn btn-info" name="search">
               </div>
           </form>
       </div>
   </div>        
</div>
</div>

<br>


</body>
</html>
