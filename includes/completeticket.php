<?php
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../index.php");
	exit();
} else{
	include 'dbconnect.php';
	
	//Stores selected ticketId
	$ticketId = $_POST['submit'];
	$date = date("Y-m-d");
	
	//updates status of ticket to undertaken, and owener to employeeId
	$sql = "UPDATE Ticket
			SET Status = 'complete', CloseDate = '$date'
			WHERE TicketId = '$ticketId';";
	mysqli_query($conn, $sql);
	
	header("Location: ../profile.php?ticketcompleted");
	exit();
}