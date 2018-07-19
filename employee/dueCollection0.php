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
                <label>Customer Branch </label>
                <input type="text" class="form-control" name="selectBranchName" value="<?php echo $_SESSION['empBranchName'];?>" required readonly />
                </div>
                </div>

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
