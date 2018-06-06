<?php
include 'db_connect.php';
session_start();

/*include 'header.php';*/

         if(isset($_POST['submit'])){

         	/*	Company Details  */
           echo $companyId = $_SESSION['companyId'];
           echo $companyName = $_SESSION['companyName'];
            /*	Customer Details  */
           echo $customerName = $_POST['customer-Name'];
           echo $customerMobile = $_POST['customer-Mobile'];
           echo $customerAddress = $_POST['customer-Address'];
           echo $branch = $_POST['branch'];
           echo $initialAmount = $_POST['initial-Amount'];
           echo $rateOfIntrest = $_POST['rate-of-intrest'];
           echo $intrestAmount = $_POST['intrest-Amount'];
           echo $totalAmount = $_POST['total-Amount'];
           echo $transitionType = $_POST['duration-type'];
		   echo $fineAmount = $_POST['fine-Amount'];
           echo $transitionStartDate = $_POST['transition-startDate'];
           echo $transitionEndDate = $_POST['transition-endDate'];
           echo $dueCount = $_POST['dueCount'];


/*$sql = "INSERT INTO rate_of_interest(companyId,companyName,branchId,branchName,)
VALUES ('$companyId','$companyName','$branchId','$branchName',$roi)";
*/
            if (mysqli_query($conn, $sql)) {
               echo "New record created successfully";
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();




           echo $dueDateVar = array();
            for($i=0; $i<$dueCount; $i++){
            	$dueDateVar[$i] = $_POST['text_$i'];
            }
            echo $dueDateVar;
           /*$show=mysqli_query($conn,"SELECT cusName, cusPhoneNo, cusAddress FROM customer_registration WHERE companyId = {$_SESSION['companyId']} AND
            cusPhoneNo = '$cusPhoneNo'");

        $res=mysqli_fetch_array($show);*/

}

?>