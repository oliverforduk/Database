<?php
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../index.php");
	exit();
} else{
	include 'dbconnect.php';
	
	//Stores selected ticketId
	$ticketId = $_POST['submit'];
	$target = $_POST['target'];
	
	//updates status of ticket to undertaken, and owener to employeeId
	$sql = "UPDATE Ticket
			SET Status = 'open', Target = '$target', Owner = 'NULL'
			WHERE TicketId = '$ticketId';";
	mysqli_query($conn, $sql);
	
	header("Location: ../ticketoptions.php?ticketcompleted");
	exit();
}