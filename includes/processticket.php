<?php
session_start();
if(!isset($_POST['submit'])){
	header("Location: index.php");
	exit();
}else{
	include 'dbconnect.php';
	
	$ticketCase = $_POST['submit'];
	$ticketId = $_POST['ticket'];
	
	//update ticket status
	$sql = "UPDATE Ticket
			SET Status = '$ticketCase'
			WHERE TicketId = '$ticketId';";
	mysqli_query($conn, $sql);
	
	//send user back to profile
	header("Location: ../profile.php");
	exit();
}