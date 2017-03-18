<?php
    session_start();
    include 'phpScripts/dbconn.php';
    if(!isset($_SESSION['user_type'])){
        header ("Location: phpScripts/loginHandler.php"); 
    }

    include 'phpScripts/getDriverInfo.php';
    include 'phpScripts/getNextRace.php';
    
  
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile </title>
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
        
        <?php 
            if($_SESSION['user_type'] == 2){
                echo "<div class=\"backArrow\"><a href=\"viewProfile.php\">   <img src=\"images/red-left-arrow.png\"></div></a>";
            }
        ?>
        
        <div class="licence <?php echo $row2['css']; ?> ">
            <div class="licencePic">
                <img src="images/profile.jpg"/>
            </div>
            <div class="licenceName">
                <h1> <?php echo $row['Name']; ?></h1>
            </div>           
            
            <div class="licenceInfo">
                    <h4>Licence No. :         <?php echo $row['Licence_No']; ?><h4>
            </div>
             <div class="licenceInfo">
                    <h4>Class. :         <?php echo $row2['class_name']; ?><h4>
            </div>
            <div class="licenceInfo">
                    <h4>Country :         <?php echo $row['Country']; ?><h4>
            </div>
           
            <div class="licenceInfo">
                    <h4>Registration Status. :         <?php if($row['Registered'] == 1) { echo "Registered";} else {echo "Unregistered";} ?><h4>
            </div>
            <div class="licenceInfo">
                    <h4>Standard :         <?php if($row['Driver_Type'] == 2) { echo "Elite";} else {echo "General";} ?><h4>
            </div>
            
        </div>
        
        
         <div class="informationHolder">
            <div>
                <h2 class="classHeading <?php echo $row2['css']; ?>">Championship Information</h2>
            </div>
            <div class=" <?php echo $row2['css']; ?> profileInformation"> <!-- Champ points -->
                <h3> Championship <br>Points<br></h3>
                <h2 class="profileInfo"> <?php echo $row3['Points'] ;?> </h2>
            </div><!-- end of Points -->
            
            <div class="<?php echo $row2['css']; ?> profileInformation"> <!-- Rank -->
                <h3> Championship Rank </h3>
                <h2 class="profileInfo"> <?php echo "#" . $dRank; ?> </h2>
            </div> <!-- end of Rank -->
            
            <div class="<?php echo $row2['css']; ?> profileInformation"> <!-- Results -->
                <h3 class="profileInfo">Class Leaderboard </h3>
                <?php 
                 
                   while( $row4 = mysqli_fetch_assoc($result4)){
                        echo "<p class=\"leaderboardDetailsDriver\">".$i. $row4['Name'] ." ". $row4['Points']."</p><br>";
                     
                    }
                ?>
            </div> <!-- end of Results -->

            <div class="<?php echo $row2['css']; ?> profileInformation"> <!-- penalty -->
                <h3 > Penalty<br> Points </h3>
                <h2 class="profileInfo"> <?php echo $row['Penalty_Points']; ?> </h2>

            </div>         
        </div> 
           <div class="informationHolder"> <!-- race -->
            <div>
                <h2 class="classHeading <?php echo $row2['css']; ?>">Race Information</h2>
            </div>
            <div  class="raceInfoDriver <?php echo $row2['css']; ?>"> <!--latest-->
                <h3> Latest Results </h3>
                <?php 
                 
                   while( $row6 = mysqli_fetch_assoc($result6)){
                        echo "<p class=\"resultsDriver\">" .$row6['position'] .") ".$row6['Name'] ."</p><br>";
                    
                    }
                ?>

               
            </div><!-- End of latest --> 
            <div  class="raceInfoDriver <?php echo $row2['css']; ?>"> <!--upcoming-->
                <h3> Upcoming  Event </h3>
                

                <?php 
                    echo "<p class=\"raceDetailsDriver\"> Race Number: " . $raceRow['race_number'] . "</h4><br>";
                    echo "<p class=\"raceDetailsDriver\"> Location: " . $town['town'] . "</h4><br>";
                    while ( $infoRow = mysqli_fetch_array( $result2 ) ){
                        echo "<p class=\"raceDetailsDriver\">" . $infoRow['type_meaning'].": ". $infoRow['date'] . "</h4><br>";
                    }  
               
                ?>
            </div><!-- End of upcoming -->
            <a href="http://www.123contactform.com/form-2390106/MI-Karting-2017-Race-Number-Registration"><div class="raceInfoDriver <?php echo $row2['css']; ?>"> <!-- Register -->
                <h3> Register Here</h3>
                 <img src="images/signup.jpg" />
            </div></a> <!-- end of Register -->           

        </div> <!-- end of race Info --> 
	<form action="phpScripts/logout.php" class="logoutButton">
			<input type="submit" value="Logout">
		</form>

    </div>
</body>
</html>