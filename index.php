<?php
	session_start();
if(isset($_SESSION['employeeId'])){
	header("Location: profile.php");
	exit();
} else {
?>

<! DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

	<form action="includes/login.php" id="login-form" method="POST">
									
		<p>Employee Id</p>
		<input type="text" name="employeeId" placeholder="your id">
										
		<p class="label">Password</p>
		<input type="password" name="password" placeholder="Password">
									
		<button type="submit" name="submit">Login</button>
									
		<!-- Error Message -->
		<?php
			if(isset($_SESSION['errorMessage'])){
				echo "<p>" . $_SESSION['errorMessage'] . "</p>";
				unset($_SESSION['errorMessage']);
			}
		?>
	</form>

</body>
</html>
<?php
}
