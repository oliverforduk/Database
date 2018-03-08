<?php
session_start();
if(!isset($_SESSION['employeeId'])){
	header("Location: index.php");
	exit();
}else{
?>

	<a href="createaccount.php"><button>Service Desk</button></a>
	<a href="infrastrucutre.php"><button>Infrastructure</button></a>
	<a href="data.php"><button>Data</button></a>
	<a href="includes/logout.php"><button>Logout</button></a>
	
<?php	
}