<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Add New Driver </title>
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
        
            <h2> Add a New Driver </h2>
        </div>
        <div class="mainForm"><!-- Form -->
            <form action="../phpScripts/newDriver.php" method="post">
            <p class="detail"> First Name:</p> <p class="userInput"> <input type="text" name="fname"> </p><br><br>          
             <p class="detail"> Last Name: </p> <p class="userInput"><input type="text" name="lname"> </p><br><br>          
             <p class="detail"> License Number:</p> <p class="userInput"><input type="text" name="driver_id"></p><br><br>
             <p class="detail"> Date of birth: </p> <p class="userInput"><input type="date" name="dob"></p><br><br>
            <p class="detail"> Class:</p> <p class="userInput">
              <select name="class">
                  <option value="1">Junior Max</option>
                  <option value="2">KZ2</option>
                  <option value="3">IAME Mini</option>
                  <option value="4">IAME Cadet</option>
                  <option value="5">Senior Max</option>
                  <option value="6">Biland</option>
                  <option value="7">Open Class 125</option>
                  <option value="8">IAME X30 Junior</option>
                  <option value="9">IAME X30 Senior</option>
                 </select></p><br><br>
               <p class="detail"> Registration Status:</p> <p class="userInput">
              <select name="registered">
                <option value="0">Unregistered</option>
                <option value="1">Registered</option>
              </select></p><br><br>
	    

                 

            <p class="detail"> Standard: </p> <p class="userInput"><select name ="standard">
                 <option value="1">General</option>
                 <option value="2">Elite</option>
                 </select></p><br/><br/>
                 <p class="detail">Country:</p> <p class="userInput"> <input type="text" name="country"></p><br><br>
                 <p class="detail">Penalty Points: </p> <p class="userInput"><input type="text" name="penalty_points" value="0"></p><br><br>
                 
                  <input type="submit" value="Save Info" class="submit">
       
            </form>
            <br>
              <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>

        </div> 
        </div><!--End of form -->
       
        
    </div> <!--end of container -->
    </body>
    </html>