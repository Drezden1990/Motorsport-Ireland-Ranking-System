<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Add New Official </title>
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
                <h4> Add a New Race Official </h4>
            </div>
            <div class="mainForm"><!-- Form -->
                <form action="../phpScripts/newOfficial.php" method="post">
                    <p class="detail"> First Name: </p> <p class="userInput"><input type="text" name="fname"/></p> <br><br>          
                    <p class="detail"> Last Name: </p> <p class="userInput"><input type="text" name="lname"/></p> <br><br>          
                    <p class="detail"> ID Number:</p> <p class="userInput"> <input type="text" name="id"/></p><br><br>
                    <label><input type="submit" value="Save Changes" class="submit"/>
           
                </form>
                    <?php
                $url = $_SERVER['REQUEST_URI'];
                if (strpos($url, 'error=empty') !== false){
                    echo "Please fill out all fields";
                }
                else if (strpos($url, 'error=user') !== false){
                    echo "ID number already in use";
                }
              
                
            ?>
            
            </div> <!--End of form -->
        </div>
        
    </div> <!--end of container -->