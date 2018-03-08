<?php
	session_start();
if(isset($_SESSION['employeeId'])){
	session_unset();
	session_destroy();
	header("Location: ../index.php");
	exit();
}else{
	header("Location: ../index.php");
	exit();
}