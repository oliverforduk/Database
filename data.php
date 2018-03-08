<?php
session_start();
//only acounts with department of 3 (data) can access content
if($_SESSION['department'] !== "3"){
	//header("Location: index.php");
	//exit();
	echo "You do not belong here.";
	echo "<a href='includes/logout.php'><button>Logout</button></a>";
	echo "<a href='profile.php'><button>Profile</button></a>";
} else {
	echo "You are authorised.";
	echo "<a href='profile.php'><button>Profile</button></a>";
}