<?php
session_start();
//only acounts with department of 1 (servicedesk) can access content
if($_SESSION['department'] !== "1"){
	header("Location: index.php");
	exit();
} else {
	include_once 'includes/dbconnect.php';
	
	$sql = "SELECT *
			FROM Employee;";
	$result = mysqli_query($conn, $sql);
	$nextId = mysqli_num_rows($result);
	$nextId = $nextId + 5;
?>
<html lang="en">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<head>
<h1><div> <br/>
	</div>Create Account<div class="fill"> <br/>
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
<body>
	<div class = "container">
		<h3>Employee Id: <?php echo $nextId; ?></h3>
		<form action="includes/addaccount.php" method="POST">
										
			<p>First Name</p>
			<input type="text" name="firstName" placeholder="First name">
			
			<p>Last Name</p>
			<input type="text" name="surname" placeholder="Last name">
			
			<p>Password</p>
			<input type="password" name="password" placeholder="Your password">
											
			<p class="label">Department</p>
			<select name="department">
				<option value="1">Service Desk</option>
				<option value="2">Infrastructure</option>
				<option value="3">Data</option>
			</select>
			<div class = "button">
										
			<button type="submit" name="submit">Add Account</button>
										
			<!-- Error Message -->
			<?php
				if(isset($_SESSION['errorMessage'])){
					echo "<p>" . $_SESSION['errorMessage'] . "</p>";
					unset($_SESSION['errorMessage']);
				}
			?>
		</form>
	
			</div>
	</div>

</body>
</html>
<?php
}