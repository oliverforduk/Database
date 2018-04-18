<?php
session_start();
//only acounts with department of 1 (servicedesk) can access content
if($_SESSION['department'] !== "1"){
	header("Location: index.php");
	exit();
} else {
?>
<html lang="en">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<head>
<h1><div> <br/>
	</div>Create A Ticket<div class="fill"> <br/>
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

	<!--Form will post ticket inputs to addticket.php-->
	<div class = "container">
		<form action="includes/addticket.php" method="POST">
			<h3> Create a Ticket</h3>
			<hr>
										
			<p>Title</p>
			<input type="text" name="ticketname" placeholder="Ticket name here."/>
			
			<p>Description</p>
			<input type="text" name="ticketdesc" placeholder="Ticket description here."/>
											
			<p class="label">Type</p>
			<select name="tickettype">
				<option value="Password Reset and General">Password Reset and General</option>
				<option value="Specialist Type">Specialist Type</option>
				<option value="Third Party">Third Party</option>
			</select>
			
			<p class="label">Target</p>
			<select name="target">
				<option value="1">Service Desk</option>
				<option value="2">Infrastrucutre</option>
				<option value="3">Data</option>
			</select>
			
			<div class = "button">						
				<button type="submit" name="submit">Create Ticket</button>
			</div>
		</form>
	</div>
		
</body>
	<!--Display tickets that are eligable for re-opening-->
<?php
}