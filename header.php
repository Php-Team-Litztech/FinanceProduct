<?php
/*session_start();*/
include_once 'db_connect.php';
?>

    <div class="navbar navbar-inverse set-radius-zero" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">

                    <img src="assets/img/logo.png" />
                </a>

            </div>

<!-- login menu -->

<?php if (isset($_SESSION['companyId'])) { ?>



            <div class="right-div">
                <a href="logout.php" class="btn btn-info pull-right">LOG OUT</a>
            </div>

            <div class="right-div">
                <button class="btn btn-info pull-right">Sign <?php echo $_SESSION['companyName']; ?> </button>
            </div>
            


<?php } else { ?>

<?php
header('Location: adminLogin.php'); 
/* Make sure that code below does not get executed when we redirect. */
exit;
?>
            
<?php } ?>


        </div>
    </div>
    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
<li><a href="index.html" >DASHBOARD</a></li>

<li>
<a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">Branch<i class="fa fa-angle-down"></i></a>
<ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
<li role="presentation"><a role="menuitem" tabindex="-1" href="ui.html">Add</a></li>
<li role="presentation"><a role="menuitem" tabindex="-1" href="#">View Branch</a></li>
</ul>
</li>

<li>
<a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown">UI ELEMENTS <i class="fa fa-angle-down"></i></a>
<ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
<li role="presentation"><a role="menuitem" tabindex="-1" href="ui.html">UI ELEMENTS</a></li>
<li role="presentation"><a role="menuitem" tabindex="-1" href="#">EXAMPLE LINK</a></li>
</ul>
</li>
<li><a href="tab.html">TABS & PANELS</a></li>
<li><a href="table.html">TABLES</a></li>
<li><a href="blank.html" >BLANK PAGE</a></li>

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>              
