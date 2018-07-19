<?php
include 'db_connect.php';
session_start();


if (isset($_SESSION['empId'])) { 
}else {
  header('Location: employeeLogin.php'); 
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

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" 
  integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <script src="assets/js/chart-master/Chart.js"></script>


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


/* Dark Blue*/

.darkblue-panel {
  text-align: center;
  background: #444c57;
}
.darkblue-panel .darkblue-header {
  background: transparent;
  padding: 3px;
  margin-bottom: 15px;
}
.darkblue-panel h1 {
  color: #f2f2f2;
}
.darkblue-panel h5 {
  font-weight: 200;
  margin-top: 10px;
  color: white;
}
.darkblue-panel footer {
  color: white;
}
.darkblue-panel footer h5 {
  margin-left:10px; 
  margin-right: 10px;
  font-weight: 700;
}


/*Green Panel*/
.green-panel {
  text-align: center;
  background: #68dff0;
}
.green-panel .green-header {
  background: #43b1a9;
  padding: 3px;
  margin-bottom: 15px;
}
.green-panel h5 {
  color: white;
  font-weight: 200;
  margin-top: 10px;
}
.green-panel h3 {
  color: white;
  font-weight: 100;
}
.green-panel p {
  color: white;
}


/*Grey Panel*/

.grey-panel {
  text-align: center;
  background: #dfdfe1;
}
.grey-panel .grey-header {
  background: #ccd1d9;
  padding: 3px;
  margin-bottom: 15px;
}
.grey-panel h5 {
  font-weight: 200;
  margin-top: 10px;
}
.grey-panel p {
  margin-left: 5px;
}
/* Specific Conf for Donut Charts*/
.donut-chart p {
  margin-top: 5px;
  font-weight: 700;
  margin-left: 15px;
}
.donut-chart h2 {
  font-weight: 900;
  color: #FF6B6B;
  font-size: 38px;
}


/*White Panel */
.white-panel {
  text-align: center;
  background: #ffffff;
  color: #ccd1d9;
}

.white-panel p {
  margin-top: 5px;
  font-weight: 700;
  margin-left: 15px;
}
.white-panel .white-header {
  background: #f4f4f4;
  padding: 3px;
  margin-bottom: 15px;
  color: #c6c6c6;
}
.white-panel .small {
  font-size: 10px;
  color: #ccd1d9;
}

.white-panel i {
  color: #68dff0;
  padding-right: 4px;
  font-size: 14px;
}

</style>



</head>
<body>
    
<?php 
include 'header.php';
?> 

<!-- admin -->
     <!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
              <div class="row pad-botm">
                  <div class="col-md-12">
                      <h4 class="header-line">EMPLOYEE DASHBOARD</h4>
                  </div>
              </div><br>


            <div class="row">
                 <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-info back-widget-set text-center">
                            <i class="fa fa-user-alt fa-5x"></i>
                            <h3><?php 

                            $count=mysqli_query($conn,"SELECT COUNT(*) FROM customer_registration");
                            $res=mysqli_fetch_array($count);
                            echo  $res['COUNT(*)'];

                              ?>+&nbsp; <i class="fa fa-dollar"></i></h3>

                           Number Of Customer
                        </div>
                    </div>
              <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-success back-widget-set text-center">
                            <i class="fa fa-user-tie fa-5x"></i>
                            <h3><?php 

                           /* echo $_SESSION['empBranchId'];*/ 

                            $query ="SELECT COUNT(*) FROM employee_registration WHERE  branchId LIKE {$_SESSION['empBranchId']}";
                            $count=mysqli_query($conn,$query);
                            $res=mysqli_fetch_array($count);
                           echo $res['COUNT(*)'];

                              ?>+</h3>
                            Number Of Employee
                        </div>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-warning back-widget-set text-center">
                            <i class="fa fa-industry fa-5x"></i>
                            <h3><?php 

                            $count=mysqli_query($conn,"SELECT COUNT(*) FROM new_transition WHERE status = 'completed' AND branchId LIKE {$_SESSION['empBranchId']}");
                            $res=mysqli_fetch_array($count);
                            echo  $res['COUNT(*)'];

                              ?>+</h3>
                           Number Of Transition completed
                        </div>
                    </div>
               <div class="col-md-3 col-sm-3 col-xs-6">
                      <div class="alert alert-danger back-widget-set text-center">
                            <i class="fa fa-recycle fa-5x"></i>
                            <h3><?php 

                            $count=mysqli_query($conn,"SELECT COUNT(*) FROM new_transition WHERE  branchId LIKE {$_SESSION['empBranchId']}");
                            $res=mysqli_fetch_array($count);
                            echo  $res['COUNT(*)'];

                              ?>+</h3>
                            Number Of Transition
                        </div>
                </div>
           </div>  



 <div class="row">
  <a href="dueCollectionBending.php">
     <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="alert alert-info back-widget-set text-center">
                <i class="fa fa-money-check-alt fa-5x"></i>
                <h3><?php 
                $date = date('Y-m-d');
                $query = "SELECT COUNT(*) FROM due WHERE status = 'Pending' AND dueDate < '$date' AND branchId LIKE {$_SESSION['empBranchId']} "; 
                $count=mysqli_query($conn,$query);
                $res=mysqli_fetch_array($count);
                if($res == null){
                  $res = 0;
                }
                echo  $res['COUNT(*)'];

                  ?>+&nbsp; <i class="fa fa-dollar"></i></h3>

               Bending Due Collection
            </div>
        </div>
  </a>


  <a href="dueCollectionCurrent.php">
  <div class="col-md-6 col-sm-6 col-xs-6">
          <div class="alert alert-success back-widget-set text-center">
                <i class="fa fa-hand-holding-usd fa-5x"></i>
                 <h3><?php 

                $date1 = date('Y-m-d');
                $count1=mysqli_query($conn,"SELECT COUNT(*) FROM due WHERE status = 'Pending' AND dueDate = '$date1' AND branchId LIKE {$_SESSION['empBranchId']}");
                $res1=mysqli_fetch_array($count1);
                echo  $res1['COUNT(*)'];

                  ?>+&nbsp; <i class="fa fa-dollar"></i></h3>

               Today Due Collection
            </div>
        </div>
    </a>
</div>  


            <div class="row">
                 <a href="newTransition.php">
                 <button type="button" class="btn btn-info btn-lg btn-block">New Transition</button>
                 </a>
                 <br>
                 <a href="dueCollection0.php">
                 <button type="button" class="btn btn-info btn-lg btn-block">Due Collection</button>
                 </a>
              </div><br><br>


                 
            
   <!--         <div class="row">
            <div class="col-md-8 col-sm-8 col-xs-12">
              <div class="panel panel-warning">
                <div class="panel-heading">
                  Recent Comments
                </div>
                <div class="panel-body">
                  <ul class="media-list">

                    <li class="media">
                      <a class="pull-left" href="#">
                        <img class="media-object img-circle img-comments" src="assets/img/user.gif" />
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading">Lorem ipsum dolor sit amet</h4>
                        <p>
                          Donec sit amet ligula enim. Duis vel condimentum massa.
                          Maecenas eget congue dui
                          interdum nibh et, volutpat dolor.
                        </p>
                                              <div class="media">
                          <a class="pull-left" href="#">
                            <img class="media-object img-circle img-comments" src="assets/img/user2.png">
                          </a>
                          <div class="media-body">
                            <h4 class="media-heading">Nulla gravida vitae neque </h4>
                            Donec sit amet ligula enim. Duis vel condimentum massa.
                            Maecenas eget congue dui. Vestibulum et eros consectetur,
                            interdum nibh et, volutpat dolor.
                          
                            <div class="media">
                              <a class="pull-left" href="#">
                                <img class="media-object img-circle img-comments" src="assets/img/user.gif" />
                              </a>
                              <div class="media-body">
                                <h4 class="media-heading">Donec sit amet ligula enim</h4>
                                Donec sit amet ligula enim. Duis vel condimentum massa.
                                Maecenas eget congue dui. Vestibulum et eros consectetur,
                                interdum nibh et, volutpat dolor.
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </li>

                  </ul>
                </div>
              </div>

            </div>
            <div class="col-md-4 col-sm-4 col-xs-12" >
              <div class="alert alert-info text-center">
                <h3> IMPORTANT NOTICE</h3> 
                <hr />
                <i class="fa fa-warning fa-4x"></i>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit gthn.
                  Lorem ipsum dolor sit amet.
                </p>
                <hr />
                <a href="#" class="btn btn-info">Read Full Detalis</a> 
              </div>
            </div>
          </div>

            -->
</div>
</div>   

</body>
</html>
