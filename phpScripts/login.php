<?php
session_start();

include 'dbconn.php';

$incorrect = "Incorrect User ID or Password";
$empty = "Please fill in all fields";


$id = $_POST['user_id'];
$pw = $_POST['pw'];

$query = "SELECT * FROM user WHERE user_id = '$id' AND pw = '$pw'";
$result = mysqli_query($conn, $query);

if(empty($id)){
    header("Location: ../loginForm.php?error=$empty");
    exit();
}
if(empty($pw)){
    header("Location: ../loginForm.php?error=$empty");
    exit();
}


else if(!$row = mysqli_fetch_assoc($result)){
    header("Location: ../loginForm.php?error=$incorrect");
    exit();
}

else{
	//echo $row['user_id'];
	//echo $row['user_type'];
	$_SESSION['id'] = $row['user_id'];
	$_SESSION['user_type'] = $row['user_type'];
	if(isset($_SESSION['id'])){
		echo $_SESSION['id'] . "    ";

	}
	
		header ("Location: loginHandler.php");
}



?>