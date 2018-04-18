<?php
session_start();
if(isset($_POST['submit'])){
	$_SESSION['ticketId'] = $_POST['submit'];
}

if(!isset($_SESSION['ticketId'])){
	header("Location: index.php");
	exit();
}else{
	include 'includes/dbconnect.php';
?>
<! DOCTYPE html>
<html lang="en">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<head>
<h1><div> <br/>
	</div>Ticket<div class="fill"> <br/>
	</div>
	</h1>
</head>
<body>
<?php	
	//Displays title relevant to account type
	if($_SESSION['department'] == "1"){
?>
	<div class="container">
		<a href="profile.php"><button>Profile</button></a>
		<a href="createaccount.php"><button>Create Account</button></a>
		<a href="createticket.php"><button>Create Ticket</button></a>
		<a href="ticketoptions.php"><button>Ticket Options</button></a>
		<a href="includes/logout.php"><button>Log Out</button></a>	
	</div>
<?php		
	}else{
?>
	<div class="container">
		<a href="profile.php"><button>Profile</button></a>
		<a href="includes/logout.php"><button>Log Out</button></a>	
	</div>
<?php		
	}

	
	//Sets variables for selecting tasks
	$employeeId = $_SESSION['employeeId'];
	$department = $_SESSION['department'];
	
	//sets taskid variable for selected task
	$ticketId = $_SESSION['ticketId'];
	
	//selects task information
	$sql = "SELECT *
			FROM Ticket
			WHERE TicketId = '$ticketId';";
	$result = mysqli_query($conn, $sql);
	
	//Output selected ticket
	while($row = mysqli_fetch_assoc($result)){
		$ticketId = $row['TicketId'];
?>
<h3>Ticket Details</h3>
<hr>
<table>
	<tr>
		<th>Title</th>
		<th>Description</th>
		<th>Status</th>
		<th>Selection</th>
	</tr>
	
	<tr>
		<td><?php echo $row['TicketName']; ?></td>
		<td><?php echo $row['TicketDesc']; ?></td>
		<td><?php echo $row['TicketDesc']; ?></td>
		<td>
			<form action="includes/processticket.php" method="POST">
				<input type="hidden" name="ticket" value="<?php echo $ticketId ?>"/>
				<button value="process" name="submit">Complete</button>
			</form>
			
			<form action="includes/processticket.php" method="POST">
				<input type="hidden" name="ticket" value="<?php echo $ticketId ?>"/>
				<button value="reasign" name="submit">Cannot Complete</button>
			</form>
		</td>
	</tr>
</table>

<?php
	}
	
	//add task form
	
?>
<h3>Comments</h3>
	<hr>
	<div class = "container">
		<form action="includes/addtask.php" method="POST">
										
			<p>Task Title</p>
			<input type="text" name="taskTitle" placeholder="Task title">
											
			<p class="label">Comment</p>
			<input type="text" name="taskComment" placeholder="Task comment">
			
			<div class = "button">							
				<button type="submit" name="submit">Add Task</button>
			</div>
		</form>
	</div>

<?php
	//show current tasks
	$sql = "SELECT *
			FROM Tasks
			WHERE TicketId = '$ticketId';";
	$result = mysqli_query($conn, $sql);
?>
<h3>All Comments</h3>
	<hr>
	<table>
  <tr>
    <th>Task Title</th>
	<th>Task Comment</th>
    <th>Date</th>
  </tr>
<?php	
	while($row = mysqli_fetch_assoc($result)){
?>
	<tr>
		<td><?php echo $row['TaskTitle']; ?></td>
		<td><?php echo $row['TaskComment']; ?></td>
		<td><?php echo $row['Date']; ?></td>
	</tr>
<?php
	}
?>
</table>
<?
}