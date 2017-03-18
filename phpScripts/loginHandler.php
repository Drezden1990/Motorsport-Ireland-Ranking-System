<?php
	session_start();
	if(isset($_SESSION['user_type'])){
		if($_SESSION['user_type'] == 3){
			header ("Location: ../driverPortal.php");
		}
		if($_SESSION['user_type'] == 2){
			header ("Location: ../officialsPortal.php");
		}
		if($_SESSION['user_type'] == 1){
			header ("Location: ../siteAdmin/siteAdminPortal.php");
		}
	}
	else{
		header ("Location: ../loginForm.php");
	}
?>