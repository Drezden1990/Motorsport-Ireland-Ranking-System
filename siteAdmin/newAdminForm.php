<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Add New Admin </title>
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
        <div class="forms">
            <div class="formHead">
                <h2> Add a New Admin </h2>
            </div>
            <div class="mainForm"><!-- Form -->
                <form action="../phpScripts/newAdmin.php" method="post">
                     <p class="detail"> First Name: </p> <p class="userInput"><input type="text" name="fname"></p> <br><br>          
                     <p class="detail"> Last Name: </p> <p class="userInput"><input type="text" name="lname"> </p><br><br>          
                     <p class="detail"> ID Number:</p> <p class="userInput"> <input type="text" name="id"></p><br><br>
                      <input type="submit" value="Save Info" class="submit">
            
                </form>
                                   <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>


            </div> <!--End of form -->
        </div>
        
    </div> <!--end of container -->