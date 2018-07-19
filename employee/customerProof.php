<?php
include 'db_connect.php';
session_start();
?>
<?php

         if(isset($_POST['search'])){

            $companyId = $_SESSION['companyId'];
            $companyName = $_SESSION['companyName'];
            $cusPhoneNo = $_POST['number'];
            
            $show=mysqli_query($conn,"SELECT cusId, cusName, cusPhoneNo, cusAddress FROM customer_registration WHERE companyId = {$_SESSION['companyId']} AND
            cusPhoneNo = '$cusPhoneNo'");

        $res=mysqli_fetch_array($show);
        ?>
        <script type="text/javascript">
            /*  To show the hidden div  */
           /* alert('sahkld');*/
            document.getElementById('customTransitionForm').style.display = "block";
        </script>


        <?php

}




if(isset($_POST['submit'])){

$companyId = $_SESSION['companyId'];
$companyName = $_SESSION['companyName'];
$cusId = $_POST['cusId'];


$proof1 = $_POST['proof1'];

$proof2 = $_POST['proof2'];

$proof3 = $_POST['proof3'];

$proof4 = $_POST['proof4'];

$proofImg1=addslashes(file_get_contents($_FILES['proofImg1']['tmp_name'])); //will store the image to fp
$proofImg2=addslashes(file_get_contents($_FILES['proofImg2']['tmp_name'])); //will store the image to fp
$proofImg3=addslashes(file_get_contents($_FILES['proofImg3']['tmp_name'])); //will store the image to fp
$proofImg4=addslashes(file_get_contents($_FILES['proofImg4']['tmp_name'])); //will store the image to fp2



$sql = "INSERT INTO `customer_proof`(companyId,companyName,cusId,1uploadProof,1proofName,2uploadProof,2proofName,3uploadProof,3proofName,4uploadProof,4proofName) VALUES ('$companyId','$companyName',$cusId,'{$proofImg1}','$proof1','{$proofImg2}','$proof2','{$proofImg3}','$proof3','{$proofImg4}','$proof4')";


            if (mysqli_query($conn, $sql)) {
               /*echo "New record created successfully";*/
                ?>
    <script type="text/javascript">
    alert('Data Are Inserted Successfully ');
    window.location.href='index.php';
    </script>
    <?php
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
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

</style> 


</head>
<body>

    <?php include 'header.php'; ?>    


     <!-- MENU SECTION END-->
<div class="content-wrapper">
     <div class="container">
    <div class="row pad-botm">
        <div class="col-md-12">
            <h4 class="header-line">Customer Proof Form</h4>
        </div>
</div>



        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2">
            </div>
            <div class="col-md-8">
              <form action = "" method = "post" role="form">
                   <div class="col-md-6">   
                    <div class="form-group">
                        <label>Customer Number</label>
                        <input class="form-control" type="number" name="number" />
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                   <input type="submit" value="Submit"  class="btn btn-info" name="search">
               </div>
           </form>
       </div>
   </div>  

        

</form>

</div>

<br><br>

     <div class="row">
         <div class="col-md-3 col-sm-3 col-xs-3">
         </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <div class="panel panel-info">
                        <div class="panel-heading">
                           Customer Proof
                        </div>
            <div class="panel-body">

            <form role="form" action = "" method = "post" enctype="multipart/form-data" >

               <div class="form-group">
                    <label>Customer Name (auto)</label>
                    <input class="form-control" type="text" id="customer-Name" name="customer-Name" value="<?php echo $res['cusName'];?>" required readonly />
                    <input hidden type="text" name="cusId" value="<?php echo $res['cusId'];?>" />

                </div>
                 <input class="form-control" type="hidden" id="customer-Name" name="customer-Id" value="<?php echo $res['cusId'];?>"/>

                <div class="form-group">
                    <label>Customer Phone no (auto)</label>
                    <input class="form-control" type="text" id="customer-Mobile" name="customer-Mobile" value="<?php echo $res['cusPhoneNo'];?>" required readonly />
                    
                </div>

                <div class="form-group">
                    <label>Customer Address (auto)</label>
                    <input type="text" class="form-control" id="customer-Address" name="customer-Address" value="<?php echo $res['cusAddress'];?>" required readonly />
                </div>

                <div class="form-group">
                    <label>1 Proof Name</label>
                    <input class="form-control" type="text" name="proof1" required />
                </div>

                <div class="form-group">
                    <label>1 Upload Proof</label>
                    <input class="form-control" type="file" name="proofImg1" required />
                </div>

                <div class="form-group">
                    <label>2 Proof Name</label>
                    <input class="form-control" type="text" name="proof2" required />
                </div>

                <div class="form-group">
                    <label>2 Upload Proof</label>
                    <input class="form-control" type="file" name="proofImg2" required />
                </div>

                <div class="form-group">
                    <label>3 Proof Name</label>
                    <input class="form-control" type="text" name="proof3" required />
                </div>

                <div class="form-group">
                    <label>3 Upload Proof</label>
                    <input class="form-control" type="file" name="proofImg3" required />
                </div>

                <div class="form-group">
                    <label>4 Proof Name</label>
                    <input class="form-control" type="text" name="proof4" required />
                </div>

                <div class="form-group">
                    <label>4 Upload Proof</label>
                    <input class="form-control" type="file" name="proofImg4" required />
                </div>

                    <button type="submit" name="submit" class="btn btn-info">Submit</button>

                    </form>
                </div>
                        </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
