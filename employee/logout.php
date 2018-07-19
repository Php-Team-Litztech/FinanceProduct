<?php
session_start();

if(isset($_SESSION['empId'])) {
	session_destroy();
	unset($_SESSION['empId']);
	unset($_SESSION['empUserName']);
	unset($_SESSION['empBranchName']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>