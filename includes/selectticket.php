<?php
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../index.php");
	exit();
} else{
	include 'dbconnect.php';
	
	//Stores selected ticketId
	$ticketId = $_POST['submit'];
	$employeeId = $_SESSION['employeeId'];
	
	//updates status of ticket to undertaken, and owener to employeeId
	$sql = "UPDATE Ticket
			SET Status = 'undertaken', Owner = '$employeeId'
			WHERE TicketId = '$ticketId';";
	mysqli_query($conn, $sql);
	
	header("Location: ../profile.php?ticketselected");
	exit();
	
}