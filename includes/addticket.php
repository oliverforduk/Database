<?php
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../index.php");
	exit();
} else{
	include 'dbconnect.php';
	//variables from createticket form
		$ticketname = mysqli_real_escape_string($conn, $_POST['ticketname']);
		$tickettype = mysqli_real_escape_string($conn, $_POST['tickettype']);
		$ticketdesc = mysqli_real_escape_string($conn, $_POST['ticketdesc']);
		$target = mysqli_real_escape_string($conn, $_POST['target']);
		
		$date = date("Y-m-d");
	
	//Error handlers here
	
	//Adds details to Ticket table
	$sql = "INSERT INTO Ticket (TicketName, TicketType, TicketDesc, Target, OpenDate) VALUES ('$ticketname', '$tickettype', '$ticketdesc', '$target', '$date');";
	mysqli_query($conn, $sql);
	
	//updating a confirmation message
	$_SESSION['successMessage'] = "Ticket created.";
				
	header("Location: ../profile.php?ticketcreated");
	exit();
	
}