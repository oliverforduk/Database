<?php
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../index.php");
	exit();
} else{
	include 'dbconnect.php';
	$ticketId = $_SESSION['ticketId'];
	$employeeId = $_SESSION['employeeId'];
	$department = $_SESSION['department'];
	
	//variables from task form
	$taskTitle = $_POST['taskTitle'];
	$taskComment = $_POST['taskComment'];
	
	$date = date("Y-m-d");
	
	//Adds task to Tasks table
	$sql = "INSERT INTO Tasks (DepartmentId, TicketId, EmployeeId, Date, TaskTitle, TaskComment) VALUES ('$department', '$ticketId', '$employeeId', '$date', '$taskTitle', '$taskComment');";
	mysqli_query($conn, $sql);
	
	//send back to ticket
	header("Location: ../ticket.php");
	exit();
	
}