<?php
    session_start();
    include 'phpScripts/dbconn.php';

    if($_SESSION['user_type'] != 2){
        header("Location: phpScripts/loginHandler.php");
    }
    include 'phpScripts/getDriverInfo.php';
    include 'phpScripts/getNextRace.php';
    
  
    
?>
<!DOCTYPE html>
<html>
<head>
    <title> Officials </title>
    <meta charset = "UTF-8" />
    <meta name ="keywords" content = "KARTING, KARTING IRELAND, MOTORSPORT, MOTORSPORT IRELAND, KART, KARTS, RACING" />
   <link rel="stylesheet" href="index.css">



</head>


<body style="background-color:white">
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
                <li><a href="phpScripts/loginHandler.php">Your Profile</li></a>

            </ul>
        </div>
        
        <h3 class="profileHeader">Official's Portal</h3>
        
        
        
        
        <a href="viewProfile.php"><div class ="officialsOptions"> <!--Drivers -->
            <div class="officialHeading">
                <h2 officialHeading> View Driver Details</h2>
            </div>
            
            <div class="officialImage">
                <img src="images/profile.jpg"/>
            </div>
        </div></a>
        
        <div class ="officialsOptions"> <!--view Discipline Forms -->
            <div class="officialHeading">
                <h2 officialHeading> View disciplinary forms</h2>
            </div>
            
            <div class="officialImage">
                <img src="images/forms.gif"/>
            </div>
        </div> <!--End of Disciplinary Forms -->
      
     
        
        
            <form action="phpScripts/logout.php" class="logoutButton">
                <input type="submit" value="Logout">
            </form>

    </div>
</body>
</html>
        
        
        
        
        
        
        
        