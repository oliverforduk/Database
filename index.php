<?php
	session_start();
if(isset($_SESSION['employeeId'])){
	header("Location: profile.php");
	exit();
} else {
?>

<html lang="en">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
<head>
	<h1><div> <br/>
	</div>
	Ticketing System Login
	<div class="fill"> <br/>
	</div>
	</h1>
	
</head>
<body>
	<div class="container">
			<form action="includes/login.php" id="login-form" method="POST">
											
				<p>Employee Id</p>
				<input type="text" name="employeeId" placeholder="your id">
												
				<p class="label">Password</p>
				<input type="password" name="password" placeholder="Password">
				
				<div class="button">
				<button type="submit" name="submit">Login</button>
				</div>
				
				<!-- Error Message -->
				<?php
					if(isset($_SESSION['errorMessage'])){
						echo "<p>" . $_SESSION['errorMessage'] . "</p>";
						unset($_SESSION['errorMessage']);
					}
				?>
			</form>
	</div>
</body>
</html>
<?php
}
