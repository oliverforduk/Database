<?php
session_start();
//only acounts with department of 1 (service desk) can access content
if($_SESSION['department'] !== "1"){
	//header("Location: index.php");
	//exit();
	echo "You do not belong here.";
	echo "<a href='includes/logout.php'><button>Logout</button></a>";
	echo "<a href='profile.php'><button>Profile</button></a>";
} else {
?>
<! DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

	<a href="includes/logout.php"><button>Logout</button></a>

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
									
		<button type="submit" name="submit">Add Account</button>
									
		<!-- Error Message -->
		<?php
			if(isset($_SESSION['errorMessage'])){
				echo "<p>" . $_SESSION['errorMessage'] . "</p>";
				unset($_SESSION['errorMessage']);
			}
		?>
	</form>
	<a href="profile.php"><button>Profile</button></a>

</body>
</html>
<?php
}