<?php
session_start();
if(!isset($_SESSION['employeeId'])){
	header("Location: index.php");
	exit();
}else{
	include 'includes/dbconnect.php';
	//Sets variables for selecting tasks
	$employeeId = $_SESSION['employeeId'];
	$department = $_SESSION['department'];
?>
<! DOCTYPE html>
<html lang="en">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<head>
<h1><div> <br/>
	</div>
<?php
//Displays title relevant to account type
	if($_SESSION['department'] == "1"){
?>
	service Desk
	<div class="fill"> <br/>
	</div>
	</h1>
</head>
<?php
	//Displays title relevant to account type
	}elseif($_SESSION['department'] == "2"){
?>
	Infrastructure Department
	<div class="fill"> <br/>
	</div>
	</h1>
</head>
<?php
	}elseif($_SESSION['department'] == "3"){
?>
	Data Department
	<div class="fill"> <br/>
	</div>
	</h1>
</head>
<?php
	}
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
?>

	
	<!--Displays open tasks targetted to the department that have NOT been undertaken by an indivisual employee-->
	<h2>Department Tickets Avaliable</h2>
<?php	
	$sql = "SELECT *
			FROM Ticket
			WHERE Target = '$department' AND Status = 'open';";
	$result = mysqli_query($conn, $sql);
	
	//Output tickets
?>
<table>
	<tr>
		<th>Title</th>
		<th>Description</th>
		<th>Selection</th>
	</tr>
<?php
	while($row = mysqli_fetch_assoc($result)){
		$ticketId = $row['TicketId'];
?>
	<tr>
		<td><?php echo $row['TicketName']; ?></td>
		<td><?php echo $row['TicketDesc']; ?></td>
		<td>
			<form action="includes/selectticket.php" method="POST">
				<button value="<?php echo $ticketId; ?>" name="submit">Select Ticket</button>
			</form>
		</td>
	</tr>

<?php
	}
?>
</table>
	
	<!--Displays open tasks targetted to the department and HAVE been undertaken by logged in employee-->
	<h2>User's Tickets</h2>
<?php
	$sql = "SELECT *
			FROM Ticket
			WHERE Target = '$department' AND Owner = '$employeeId' AND Status = 'undertaken';";
	$result = mysqli_query($conn, $sql);
	
	//Output tickets
?>
<table>
	<tr>
		<th>Title</th>
		<th>Description</th>
		<th>Selection</th>
	</tr>
<?php
	while($row = mysqli_fetch_assoc($result)){
		$ticketId = $row['TicketId'];
?>
	<tr>
		<td><?php echo $row['TicketName']; ?></td>
		<td><?php echo $row['TicketDesc']; ?></td>
		<td>
			<form action="ticket.php" method="POST">
				<button value="<?php echo $ticketId; ?>" name="submit">Handle Ticket</button>
			</form>
		</td>
	</tr>
<?php
	}
?>
</table>
<?php
}