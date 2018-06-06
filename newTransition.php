<?php
include 'db_connect.php';
session_start();
?>
<?php

$result=  mysqli_query($conn, "SELECT MAX(transitionId) as transitionId FROM new_transition") or die (mysqli_error());

while($transId=mysqli_fetch_array($result))
{    
echo $transitionId= 1 + $transId['transitionId'];

}
                
        

/*for select the customer by there number*/
         if(isset($_POST['search'])){

            $companyId = $_SESSION['companyId'];
            $companyName = $_SESSION['companyName'];
            $cusPhoneNo = $_POST['number'];
            
            $show=mysqli_query($conn,"SELECT cusId, cusName, cusPhoneNo, cusAddress FROM customer_registration WHERE companyId = {$_SESSION['companyId']} AND
            cusPhoneNo = '$cusPhoneNo'");

        $res=mysqli_fetch_array($show);
}
        /*for insert into DB */


        if(isset($_POST['submit'])){

            /*  Company Details  */
           $companyId = $_SESSION['companyId'];
           $companyName = $_SESSION['companyName'];
            /*  Customer Details  */
           $customerId = $_POST['customer-Id'];
           $customerName = $_POST['customer-Name'];
           $customerMobile = $_POST['customer-Mobile'];
           $customerAddress = $_POST['customer-Address'];

           $branchId = $_POST['branch'];
           $branchName = $_POST['selectBranchName'];

           $initialAmount = $_POST['initial-Amount'];
           $rateOfIntrest = $_POST['rate-of-intrest'];
           $intrestAmount = $_POST['intrest-Amount'];
           $totalAmount = $_POST['total-Amount'];
           $transitionType = $_POST['duration-type'];
           $fineAmount = $_POST['fine-Amount'];
           $transitionStartDate = $_POST['transition-startDate'];
           $transitionEndDate = $_POST['transition-endDate'];
           $dueCount = $_POST['dueCount'];
           $dueAmount = $_POST['dueAmount'];

           $sql = " INSERT INTO new_transition(companyId, companyName, branchId, branchName, cusId, cusName, cusPhoneNo, cusAddress, initialAmount, rateOfInterest, interestAmount, totalAmount, transitionType, fineAmountPerDate, startingDate, endingDate, noOfCount, status) 
           VALUES                             ('$companyId', '$companyName', '$branchId', '$branchName', '$customerId','$customerName','$customerMobile', '$customerAddress','$initialAmount','$rateOfIntrest','$intrestAmount','$totalAmount','$transitionType','$fineAmount','$transitionStartDate', '$transitionEndDate','$dueCount','pending')";

            if (mysqli_query($conn, $sql)) {
               echo "New record created successfully";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }

           $dueDateVar = "";
            for($i=0; $i<$dueCount; $i++){
                if($dueDateVar != ""){
                    $dueDateVar = $dueDateVar . "+" . $_POST['text_'.$i] ;
                }else{
                    $dueDateVar = $_POST['text_'.$i];
                }
            }
            
            $dueArray = explode("+", $dueDateVar);
            echo $dueDateVar[0];
            echo $dueArray[1];

            for($i=0; $i<sizeof($dueArray); $i++){
                echo "ARRAY ---------- ".$dueArray[$i];
$insertQuery = "INSERT INTO due(companyId, companyName, branchId, branchName, transitionId, dueDate, dueAmount, interestAmount, fineAmount, totalAmount, paidDate, paidAmount, balanceAmount, amountReceiver, status) VALUES ('$companyId', '$companyName', '$branchId', '$branchName', '$transitionId', '$dueArray[$i]', '$dueAmount', '$intrestAmount', '$fineAmount', '$totalAmount', '0', '0', '$totalAmount', '$companyId', 'Pending')";
                if (mysqli_query($conn, $insertQuery)) {
                   //echo "New record created successfully";
                } else {
                   echo "Error: " . $sql . "" . mysqli_error($conn);
                }
            }
            $conn->close();
        
            

}

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>FREE RESPONSIVE HORIZONTAL ADMIN</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>

    <?php include 'header.php'; ?>     


    <!-- MENU SECTION END-->
    <div class="content-wrapper">
       <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Customer New Transition Form</h4>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input class="form-control" type="text"  />
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                   <input type="submit" value="Submit" class="btn btn-info" name="search">
               </div>
           </form>
       </div>
   </div>        




   <div class="row" id="customTransitionForm" style="display:;">
       <div class="col-md-3 col-sm-3 col-xs-3">
       </div>
       <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="panel panel-info">
            <div class="panel-heading">
             Customer New Transition
         </div>
         <div class="panel-body">

            <form action = "" method = "post" role="form">

                <div class="form-group">
                    <label>Customer Name (auto)</label>
                    <input class="form-control" type="text" id="customer-Name" name="customer-Name" value="<?php echo $res['cusName'];?>" required />

                </div>
                 <input class="form-control" type="hidden" id="customer-Name" name="customer-Id" value="<?php echo $res['cusId'];?>"/>

                <div class="form-group">
                    <label>Customer Phone no (auto)</label>
                    <input class="form-control" type="text" id="customer-Mobile" name="customer-Mobile" value="<?php echo $res['cusPhoneNo'];?>" required />
                    
                </div>

                <div class="form-group">
                    <label>Customer Address (auto)</label>
                    <input type="text" class="form-control" id="customer-Address" name="customer-Address" value="<?php echo $res['cusAddress'];?>" required >
                </div>

                <div class="form-group">
                    <label>Select Branch</label>
                    <select name="branch" id="branch" class="form-control" id="box1" onChange="getSelectedText(this);"  required>
                        <option value="">None</option>

                        <?php
                        $query ="SELECT branchName, branchId FROM branch WHERE companyId LIKE {$_SESSION['companyId']} Group by branchName  ";
                        $result= mysqli_query($conn,$query);
                        while($row=mysqli_fetch_array($result))
                        {    
                            echo '<option value="'.$row['branchId'].'">'.$row['branchName'].'</option>';
                        }
                        ?>
                    </select>
                    <input type="hidden" name="selectBranchName" id="selectBranchName_hidden">
                </div>

<!-- for get the text of selected drop down -->
<script>
function getSelectedText(sel)
{
var getText = (sel.options[sel.selectedIndex].text);
document.getElementById("selectBranchName_hidden").value = getText;
//$("#selectBranchName_hidden").val(("#box1").find(":selected").text());
//alert(getText);
}
</script>
    
                <div class="form-group">
                <label>Select Transition Type</label>
                <select name="duration-type" class="form-control" id="box1" required>
                <option value="">None</option>

                <?php
                $query ="SELECT durationType FROM type_of_duration WHERE companyId = {$_SESSION['companyId']} Group by durationType  ";
                $result= mysqli_query($conn,$query);

                while($row=mysqli_fetch_array($result))
                {    

                echo '<option value="'.$row['durationType'].'">'.$row['durationType'].'</option>';
                
                }
                ?>
                </select>
                </div>



                <div class="form-group">
                    <label>Initial Amount</label>
                    <input class="form-control" type="number" id="initial-Amount" name="initial-Amount" required />
                    
                </div>

                <div class="form-group">
                <label>Select Rate Of Interest</label>
                <select name="rate-of-intrest" class="form-control" id="ROI" onchange="Interest()" required>
                <option value="">None</option>

                <?php
                $query ="SELECT interestRate FROM rate_of_interest WHERE companyId = {$_SESSION['companyId']} Group by interestRate  ";
                $result= mysqli_query($conn,$query);

                while($row=mysqli_fetch_array($result))
                {    

                echo '<option value="'.$row['interestRate'].'">'.$row['interestRate'].'</option>';
                
                }
                ?>
                </select>
                </div>


<!-- for calc rate of interest -->
<script type="text/javascript">
function Interest() {

var intialAmount = parseInt(document.getElementById("initial-Amount").value);
var rateOfInterest = parseInt(document.getElementById("ROI").value);

var result = intialAmount*(rateOfInterest/100);
/*alert(result);*/

document.getElementById("intrest-Amount").value = result;
document.getElementById("total-Amount").value = result + intialAmount;

}
</script>



               <div class="form-group">
                <label>Intrest Amount</label>
                <input class="form-control" type="number" id="intrest-Amount" name="intrest-Amount" required />
                </div>

                <div class="form-group">
                    <label>Total Amount</label>
                    <input class="form-control" type="number" id="total-Amount" name="total-Amount" required />
                </div>

               <div class="form-group">
                    <label>Fine Amount Per day</label>
                    <input class="form-control" type="number" id="fine-Amount" name="fine-Amount" required />
                </div>

                <div class="form-group">
                    <label>Starting Date</label>
                    <input class="form-control" type="date" id="transition-startDate" name="transition-startDate" required />
                </div>

                <div class="form-group">
                    <label>Ending Date</label>
                    <input class="form-control" type="date" id="transition-endDate" name="transition-endDate" required />
                </div>

                <div class="form-group">
                    <label>No Of Due Count</label>
                    <input class="form-control" type="number" id="dueCount" name="dueCount" required />
                </div>

                <center>
                    <button type="button" onclick="showDueForm()" class="btn btn-info">Show Due Dates</button>
                </center>


                <script type='text/javascript'>
                    function showDueForm(){
                                // Number of inputs to create
                                var number = document.getElementById("dueCount").value;
                                var amount = document.getElementById("total-Amount").value;
                                var dueAmount =Math.ceil(amount/number);
                                console.log("dueAmount", dueAmount);
                                document.getElementById("dueAmount").value = dueAmount;
                                // Container <div> where dynamic content will be placed
                                var container = document.getElementById("container");
                                // Clear previous contents of the container
                                while (container.hasChildNodes()) {
                                    container.removeChild(container.lastChild);
                                }
                                for (i=0;i<number;i++){
                                // Append a node with a random text
                                container.appendChild(document.createElement("h1"));
                                container.appendChild(document.createTextNode(" Due Amount = " + dueAmount));
                                container.appendChild(document.createElement("br"));
                                container.appendChild(document.createTextNode("Due Date " + (i+1)));
                                
                                // Create an <input> element, set its type and name attributes
                                var input = document.createElement("input");
                                input.classList.add("form-control");
                                input.type = "date";
                                input.name = "text_" + i;
                                input.id = "text_" + i;
                                container.appendChild(input);
                                // Append a line break 
                                container.appendChild(document.createElement("br"));
                            }

                           /* var inputButton = document.createElement("input");
                                inputButton.type = "submit";
                                inputButton.name = "submit";
                                inputButton.value = "Insert";
                                container.appendChild(inputButton);*/
                            
                        }
                </script>

                    <!-- main due form -->

                    <div class='form-group' id="container" >
                        <!-- Content is in the above Script tag -->
                    </div>

                    <input type="hidden" name="dueAmount" id="dueAmount">










                    <input type="submit" class="btn btn-info" value="Submit" name="submit">

             </form>
        </div>
    </div>
 
</div>
</div>
</div>





<!-- CONTENT-WRAPPER SECTION END-->
<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
             &copy; 2014 Yourdomain.com |<a href="http://www.binarytheme.com/" target="_blank"  > Designed by : binarytheme.com</a> 
         </div>

     </div>
 </div>
</section>


<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
