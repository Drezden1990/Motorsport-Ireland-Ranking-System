<?php
   session_start();
?>

<?php
	if(isset($_SESSION['id'])){
	header ("Location: phpScripts/loginHandler.php");
	//header ("Location: driverProfile.php");
}
?>
}
<!doctype html>
<html>

<head>
    <title>login</title>
    <meta charset = "UTF-8" />
    <meta name ="keywords" content = "KARTING, KARTING IRELAND, MOTORSPORT, MOTORSPORT IRELAND, KART, KARTS, RACING" />
    <link rel="stylesheet" href="index.css"> 



</head>


<body>
    <div class="container"> <!-- frame page -->
        <div class="top">
            <img class="logo" src="images/Motorsport_Ireland_white_text.png" />
        </div>
        <div class="nav"> <!-- Nav Bar -->
            <ul>
               <li><a href="index.php">Home</li></a>
                <li><a href="technical.php">Technical</li></a>
                <li><a href="regulations.php">Regulations</li></a>
                <li><a href="viewResults.php">Results</li></a>
                <li><a href="leaderboards.php">Leaderboards</li></a>
                <li><a href="/phpScripts/loginHandler.php">Your Profile</li></a>

            </ul>
        </div> <!-- End of Nav -->
        <div class="forms"><!-- form container-->
            <div class="formHead"><!--heading-->
                <h3> Login </h3>
            </div><!--end of heading-->
            <div class="mainForm"><!-- form-->
                <form action="phpScripts/login.php" method="POST">
                    <p class="detail">  User/Driver ID: </p>
                    <p class="userInput">   <input type="text" name="user_id"> </p><br><br>   
                    <p class="detail">   Password: </p>
                    <p class="userInput">  <input type="password" name="pw"></p> <br><br>  		
                    <input type="submit" value="Login" class="submit">
                </form>
           <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>
            </div>
        <div>
    <div> <!-- end of container-->
<body>
</html>