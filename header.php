<?php
/*session_start();*/
include_once 'db_connect.php';
?>


<nav class="navbar navbar-default menu-section">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Finance</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Branch<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="branch.php">Branch Registration</a></li>
            <li><a href="branchView.php">Branch View</a></li>
          </ul>
        </li>

<!--         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Type Of Duration<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="typeOfDuration.php">Duration Registration</a></li>
            <li><a href="typeOfDurationView.php">Duration View</a></li>
          </ul>
        </li> -->

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Rate Of Interest<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="rateOfInterest.php">ROT Registration</a></li>
            <li><a href="rateOfInterestView.php">ROT View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Employee<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="employeeRegistration.php">Employee Registration</a></li>
            <li><a href="employeeRegistrationView.php">Employee View</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Customer<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="customerRegistration.php">Customer Registration</a></li>
            <li><a href="customerRegistrationView.php">Customer View</a></li>
            <li><a href="customerProof.php">Customer Proof Registration</a></li>
            <li><a href="customerProofView.php">Customer Proof View</a></li>
          </ul>
        </li>

         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="">Expenses<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="expence.php">Expenses Registration</a></li>
            <li><a href="expenceView.php">Expenses View</a></li>
          </ul>
        </li>


<!-- 
        <li><a href="#">About</a></li> -->
      </ul>

<?php if (isset($_SESSION['companyId'])) { ?>

<ul class="nav navbar-nav navbar-right">
<li><a href="#"><span class="glyphicon glyphicon-log-in"></span><?php echo $_SESSION['companyName']; ?></a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span>LOG OUT</a></li>
</ul>

<?php
 } 
 else
 {
/*unset($_SESSION['companyId']);*/
/*try{*/
  header('Location: adminLogin.php'); 
/*} catch(Exception $e){
  
}*/

/* Make sure that code below does not get executed when we redirect. */
exit;
 } 

 ?>


    </div>
  </div>
</nav>
</section>
  