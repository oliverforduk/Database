<?php
session_start();

if(isset($_POST['submit'])){
	
	include_once 'dbconnect.php';
	
	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$surname = mysqli_real_escape_string($conn, $_POST['surname']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$department = mysqli_real_escape_string($conn, $_POST['department']);
	
	//Error handlers
	//check for empty fields (fix, this doesnt work atm)
	//if (empty($firstName || $sername)){
		//$_SESSION['errorMessage'] = "Please complete form.";
		//header("Location: ../createaccount.php");
		//exit();
	//} 
	
	//Hashing password
	$hashpassword = password_hash($password, PASSWORD_DEFAULT);
				
	//Insert details into database
	$sql = "INSERT INTO Employee (FirstName, Surname, Password, DepartmentId) VALUES ('$firstName', '$surname', '$hashpassword', '$department');";
	mysqli_query($conn, $sql);
				
	//updating a confirmation message
	$_SESSION['successMessage'] = "Account created, please sign in.";
				
	header("Location: ../index.php?signup=success");
	exit();
} else{
	echo "no post";
}