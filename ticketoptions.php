<?php
session_start();
//only acounts with department of 1 (servicedesk) can access content
if($_SESSION['department'] !== "1"){
	header("Location: index.php");
	exit();
} else {
	include 'includes/dbconnect.php';
?>
<html lang="en">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<head>
<h1><div> <br/>
	</div>Ticket Options<div class="fill"> <br/>
	</div>
	</h1>
</head>
<body>
	<div class="container">
		<a href="profile.php"><button>Profile</button></a>
		<a href="createaccount.php"><button>Create Account</button></a>
		<a href="createticket.php"><button>Create Ticket</button></a>
		<a href="ticketoptions.php"><button>Ticket Options</button></a>
		<a href="includes/logout.php"><button>Log Out</button></a>	
	</div>

<?php
	
	//selects tickets that must be set to complete
	$sql = "SELECT *
			FROM Ticket
			WHERE Status = 'process';";
	$result = mysqli_query($conn, $sql);
	
	//outputs tickets to be set to complete
?>
<h3>Complete Tickets</h3>
<hr>

<table>
  <tr>
    <th>Title</th>
    <th>Description</th>
    <th>Status</th>
	<th>Ticket Options</th>
  </tr>
 <?php
	while($row = mysqli_fetch_assoc($result)){
		$ticketId = $row['TicketId'];
?>
	<tr>
		<td><?php echo $row['TicketName']; ?></td>
		<td><?php echo $row['TicketDesc']; ?></td>
		<td><?php echo $row['status']; ?></td>
		<td>
			<form action="ticket.php" method="POST">
				<button value="<?php echo $ticketId; ?>" name="submit">View Ticket</button>
			</form>
			
			<form action="includes/completeticket.php" method="POST">
				<button value="<?php echo $ticketId; ?>" name="submit">Complete Ticket</button>
			</form>
		</td>
	</tr>
	
<?php
	}
?>
	</table>
<?php
	//selects tickets that must be reasigned
	$sql = "SELECT *
			FROM Ticket
			WHERE Status = 'reasign';";
	$result = mysqli_query($conn, $sql);
	
	//outputs tickets to be reasigned
?>
<h3>Reasign Tickets</h3>
<hr>

<table>
  <tr>
    <th>Title</th>
    <th>Description</th>
	<th>Ticket Options</th>
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
				<button value="<?php echo $ticketId; ?>" name="submit">View Ticket</button>
			</form>
			
			<form action="includes/reasignticket.php" method="POST">
				<select name="target">
					<option value="1">Service Desk</option>
					<option value="2">Infrastrucutre</option>
					<option value="3">Data</option>
				</select>
			
				<button value="<?php echo $ticketId; ?>" name="submit">Reasign Ticket</button>
			</form>
		</td>
	</tr>
<?php
	}
?>
</table>
<?php
}