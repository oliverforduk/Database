<?php
session_start();

if(!isset($_POST['submit'])){
	header("Location: ../index.php");
	exit();
} else{
	include 'dbconnect.php';
	
	$employeeId = mysqli_real_escape_string($conn, $_POST['employeeId']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	//Error handlers
	//Check for empty fields
	if(empty($employeeId) || empty($password)){
		
		header("Location: ../index.php?login=error");
		$_SESSION['errorMessage'] = "Please complete form.";
		exit();
	} else{
		
		//Checks the account exists
		$sql = "SELECT * FROM Employee Where EmployeeId='$employeeId';";
		$result = mysqli_query($conn, $sql);
		$accountcheck = mysqli_num_rows($result);
		
		if($accountcheck < 1){
			
			header("Location: ../index.php?login=error");
			$_SESSION['errorMessage'] = "Account does not exist.";
			exit();
		} else{
			
			if($row = mysqli_fetch_assoc($result)){
				
				//Dehash password and check
				$hashpasswordcheck = password_verify($password, $row['Password']);
				if($hashpasswordcheck == false){
					header("Location: ../index.php?login=error");
					$_SESSION['errorMessage'] = "Email and password do not match.";
					exit();
				} elseif ($hashpasswordcheck == true){
					
					//logs in user (department varibale used to determine which pages user has access to)
					$_SESSION['employeeId'] = $row['EmployeeId'];
					$_SESSION['department'] = $row['DepartmentId'];
					header("Location: ../profile.php?login=success");
					exit();
				}
			}
		}
	}
}