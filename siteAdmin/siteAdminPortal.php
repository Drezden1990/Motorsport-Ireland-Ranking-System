<?php
    session_start();
?>

<!doctype html>
<html>

<head>
    <title> Site Admin </title>
    <meta charset = "UTF-8" />
    <meta name ="keywords" content = "KARTING, KARTING IRELAND, MOTORSPORT, MOTORSPORT IRELAND, KART, KARTS, RACING" />
    <link rel="stylesheet" href="../index.css"> 



</head>


<body>
<div class="container adminPage"> <!-- frame page -->
    <div class="top">
        <img class="logo" src="../images/Motorsport_Ireland_white_text.png" />
    </div>
    <div class="nav"> <!-- Nav Bar -->
    <ul>
                <li><a href="../index.php">Home</li></a>
                <li><a href="../technical.php">Technical</li></a>
                <li><a href="../regulations.php">Regulations</li></a>
                <li><a href="../viewResults.php">Results</li></a>
                <li><a href="../leaderboards.php">Leaderboards</li></a>
                <li><a href="../phpScripts/loginHandler.php">Your Profile</li></a>
    </ul>
    </div> <!-- End of Nav -->
    <div>
        <h1 class="profileHeader">Site Admin Portal</h1>
    </div>

    <a href="addEventForm.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Add a New Racing Event</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/kart.png">
	  </div>
    </div></a>

    <a href="updateEventForm.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Update Racing Event</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/updateRaceEvent.png">
	  </div>
    </div></a>

    <a href="deleteRace.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Delete Racing Event</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/deleteRaceEvent.png">
	  </div>
    </div></a>
    
    <a href="uploadRaceResults.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Add New Race Results</h3>
	  </div>
      <div class="adminImages">
		<img src="../images/addResults.png">
	  </div>
    </div></a>

    <a href="uploadRaceResults.php?update"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Update Existing Race Results</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/changeRaceResults.png">
	  </div>
    </div></a>

    <div class="adminOptions">
	  <div class="adminHeading">
		<h3>Clear Championship<h3>
	  </div>
          <div class="adminImages">
		<img src="../images/clearChampionship.png">
	  </div>
    </div>
    
    <a href="driverForm.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Add a New Driver</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/driver_icon.jpg">
	  </div>
    </div></a>

    <a href="editDriverFormpt1.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Update Driver Info</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/updateDriver.jpg">
	  </div>
    </div></a>

    <a href="deleteDriver.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Remove a Driver</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/removeDriver.jpg">
	  </div>
    </div></a>
    
    <a href="newAdminForm.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Add a New Site Admin</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/addAdmin.png">
	  </div>
    </div></a>


    <a href="newOfficialForm.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Add a New Race Official</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/addOfficial.png">
	  </div>
    </div></a>
  
    <a href="deleteOfficial.php"><div class="adminOptions">
	  <div class="adminHeading">
		<h3>Remove a Race Official</h3>
	  </div>
          <div class="adminImages">
		<img src="../images/removeOfficial.png">
	  </div>
    </div><a>



<form  class="logoutButton" action="../phpScripts/logout.php">
			<input type="submit" value="Logout" >
		</form>
    
    
    
</div> <!--End of Container-->
</body>
</html>