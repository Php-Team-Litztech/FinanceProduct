<?php
include 'db_connect.php';
session_start();
?>
<?php

$result=  mysqli_query($conn, "SELECT MAX(transitionId) as transitionId FROM new_transition") or die (mysqli_error());

while($transId=mysqli_fetch_array($result))
{    
$transitionId= 1 + $transId['transitionId'];

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
           $dueCount = $_POST['dueCount'];
           $dueAmount = $_POST['dueAmount'];


           

           $sql = " INSERT INTO new_transition(companyId, companyName, branchId, branchName, cusId, cusName, cusPhoneNo, cusAddress, initialAmount, rateOfInterest, interestAmount, fineAmount, totalAmount, transitionType, fineAmountPerDate, startingDate, noOfCount, status) 
           VALUES                             ('$companyId', '$companyName', '$branchId', '$branchName', '$customerId','$customerName','$customerMobile', '$customerAddress','$initialAmount','$rateOfIntrest','$intrestAmount','$fineAmount' , '$totalAmount','$transitionType','$fineAmount','$transitionStartDate','$dueCount','pending')";

            if (mysqli_query($conn, $sql)) {
              /* echo "New record created successfully";*/
                 ?>
        <script type="text/javascript">
        alert('Successfully new trasition is process');
        window.location.href='index.php';
        </script>

        <?php
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
            $dueDateVar[0];
            $dueArray[1];

            for($i=0; $i<sizeof($dueArray); $i++){
                echo "ARRAY ---------- ".$dueArray[$i];
               $insertQuery = "INSERT INTO due(companyId, companyName, branchId, branchName, transitionId, dueDate, dueAmount, interestAmount, fineAmount, totalAmount, paidDate, paidAmount, balanceAmount, amountReceiver, status) VALUES ('$companyId', '$companyName', '$branchId', '$branchName', '$transitionId', '$dueArray[$i]', '$dueAmount', '$intrestAmount', '$fineAmount', '$totalAmount', '0', '0', '$dueAmount', '$companyId', 'Pending')";
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

    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


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
                <h4 class="header-line">Customer New Transition Form</h4>
            </div>
        </div>   

   <div class="row" id="customTransitionForm">
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
                    <input class="form-control" type="text" id="customer-Name" name="customer-Name" value="<?php echo $res['cusName'];?>" required readonly />

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
                    <label>Select Branch</label>
                    <select name="branch" id="branch" class="form-control" id="box1"  value="<?php echo $_SESSION['empBranchName'];?>" required readonly >
                    </select>
                </div>

                <div class="form-group">
                    <label>Requirement Amount</label>
                    <input class="form-control" type="number" id="Requirement-Amount" name="Requirement-Amount" required />
                    
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

var intialAmount = parseInt(document.getElementById("Requirement-Amount").value);
var rateOfInterest = parseInt(document.getElementById("ROI").value);

var result = Math.ceil(intialAmount*(rateOfInterest/100));


document.getElementById("intrest-Amount").value = result;
document.getElementById("total-Amount").value = intialAmount;

document.getElementById("initial-Amount").value = intialAmount - result ;

}
</script>     


              <div class="form-group">
              <label>Initial Amount</label>
              <input class="form-control" type="number" id="initial-Amount" name="initial-Amount" required readonly/>
              </div>

               <div class="form-group">
                <label>Intrest Amount</label>
                <input class="form-control" type="number" id="intrest-Amount" name="intrest-Amount" required readonly />
                </div>

                <div class="form-group">
                    <label>Total Amount</label>
                    <input class="form-control" type="number" id="total-Amount" name="total-Amount" required readonly />
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
                <label>Select Transition Type</label>
                <select name="duration-type" class="form-control" id="type_Of_duration" onchange="calcNoOfDue(this)"  required>
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

                <script type="text/javascript">
                  function calcNoOfDue() {
                    var typeOfDuration = document.getElementById("type_Of_duration").value;
                    console.log(typeOfDuration);
                    
                    if(typeOfDuration == 'one mounth' || typeOfDuration == 'Ten Days')
                    {
                      document.getElementById("dueCount").value = '1';
                      document.getElementById("dueCount").readOnly = true;
                    } else {
                      document.getElementById("dueCount").value = null;
                      document.getElementById("dueCount").readOnly = false;
                    }

                  }
                </script>

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
                                var typeOfDuration = document.getElementById("type_Of_duration").value;

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
                                input.type = "text";
                                input.name = "text_" + i;
                                input.id = "text_" + i;
                                input.maxlength = "15";
                                container.appendChild(input);
                                // Append a line break 
                                container.appendChild(document.createElement("br"));
                            }


                          calculateDueDates(number);
                            
                        }
                    function calculateDueDates(noOfDues){

                        /*  For Calculating Saturdays(one week) */
                        var date = new Date(); 
                        var beforeSaturday = new Date();
                        var nextDay = new Date();
                        //var dayCount = 0;
                        var dayCountBefore = 0;
                        date.setDate(date.getDate());
                        var day = date.getDay();
                        /*  To Calculate the next Satetments  */
                        let duration = document.getElementById('type_Of_duration').value;
                        var dateIncrement = 0;

                        if(duration == 'Ten Days'){
                            dateIncrement = 10;
                            nextDay.setDate(date.getDate() + dateIncrement);
                        } else if(duration == 'one mounth'){
                            dateIncrement = 1;
                            nextDay.setMonth(date.getMonth() + dateIncrement);
                        } else if(duration == 'one week'){
                          dateIncrement = 7;

                          if(day == 0){
                            //dayCount = 6;
                            dayCountBefore = 1;
                          } else if(day == 1) {
                            dayCountBefore = 2;
                          } else if(day == 2) {
                            dayCountBefore = 3;
                          } else if(day == 3) {
                            dayCountBefore = 4;
                          } else if(day == 4) {
                            dayCountBefore = 5;
                          } else if(day == 5) {
                            dayCountBefore = 6;
                          } else if(day == 6) {
                            dayCountBefore = 0;
                          }
                        beforeSaturday.setDate(date.getDate() - dayCountBefore);
                        nextDay.setDate(beforeSaturday.getDate() + dateIncrement);

                        } else if(duration == 'one day'){
                          dateIncrement = 1;
                          nextDay.setDate(date.getDate() + dateIncrement);
                        }
                        
                        console.log('Current Date = ' + date);
                        console.log('Before Saturday = ', beforeSaturday)
                        console.log('After Saturday = ', nextDay);
                        
                        for(var i=0; i<noOfDues; i++){
                          var textField = document.getElementById('text_'+i);
                          /*if(duration == 'one mounth'){
                            var day = nextDay.getDay();
                            var month = nextDay.getMonth() + 1;
                            var year = nextDay.getFullYear();
                            textField.value = 
                          }*/
                          textField.value = formatDate(nextDay);
                          nextDay.setDate(nextDay.getDate() + dateIncrement);

                        }




                    }
                    function formatDate(date) { 
                      var d = new Date(date), 
                          month = '' + (d.getMonth() + 1), 
                          day = '' + d.getDate(), 
                          year = d.getFullYear(); 

                      if (month.length < 2) month = '0' + month; 
                      if (day.length < 2) day = '0' + day; 

                      return [year, month, day].join('-'); 
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





<?php 
include 'footer.php';
?>


</body>
</html>
