<?php
    session_start();
    include 'phpScripts/dbconn.php';


    include 'phpScripts/getDriverInfo.php';
    include 'phpScripts/getNextRace.php';
    
  
    
?>
<!DOCTYPE html>
<html>
<head>
    <title> Race Results </title>
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
        
        <h1 class="profileHeader"> Race Results</h1>
        <div class="leaderboard">
            <form action="viewResults.php" method="get">
            <p class="detail">Choose a race:</p><p class="userInput"> <select name="race_number">
            <?php
                $str1 = "<option value=\"";
                $str2 = "\">";

                    //only show races which have results uploaded already
                    $getRaces = "SELECT r.race_number, t.town FROM race r, track t where race_type = 1 and r.track_no = t.track_id and r.race_number in (select race_num from results)";
                    $result = mysqli_query($conn, $getRaces);
               

                while($row = mysqli_fetch_assoc($result)){
                    echo ($str1).$row['race_number']. ($str2) . "Race " .$row['race_number']. ": " .$row['town']. "</option>";
            }
            ?>
            </select></p><br><br>
            <p class="detail">Select a race type: </p><p class="userInput"><select name="race_type_id">
                <option value="1">Pre Final</option>
                <option value="2">Final</option>
                </select></p>
           <p class="detail">Select a class: </p><p class="userInput"><select name="class">
                <option value="1">Junior Max</option>
                <option value="2">KZ2</option>
                <option value="3">IAME Mini</option>
                <option value="4">IAME Cadet</option>
                <option value="5">Senior Max</option>
                <option value="6">Biland</option>
                <option value="7">Open Class 125</option>
                <option value="8">IAME X30 Junior</option>
                <option value="9">IAME X30 Senior</option>
                </select></p>
                <input type="submit" class="submit">
             </form>
        </div>
         
         <?php
            if(isset($_GET['class'])){
                $getclass = "SELECT * from class where class_id = '$_GET[class]'";
                $getResult = mysqli_query($conn, $getclass);
                $className = mysqli_fetch_assoc($getResult);
                
                if(isset($_GET['race_number'])){
                  $sql = "SELECT d.Name , r.position,r.race_num, r.race_type_id, r.race_class FROM results r, driver d where race_num = '$_GET[race_number]' and race_type_id = '$_GET[race_type_id]' and race_class = '$_GET[class]' and d.Licence_No = r.driver_id and r.position >0 order by r.position asc";
                   $result = mysqli_query($conn, $sql);
                    $rNum = $_GET['race_number'];
                }
                else {
                            $race= "select race_num from results order by race_num desc limit 1";
                            $raceQuery = mysqli_query($conn, $race);
                            $raceRow = mysqli_fetch_assoc($raceQuery);
                            $rNum = $raceRow['race_num'];
                            $type = "SELECT race_type_id from results where race_num = '$raceRow[race_num]' order by race_type_id desc limit 1";
                            $typeQuery = mysqli_query($conn, $type);
                            $typeRow = mysqli_fetch_assoc($typeQuery);
                            $sql = "SELECT d.Name , r.position,r.race_num, r.race_type_id, r.race_class FROM results r, driver d where race_num = '$raceRow[race_num]' and race_type_id = '$typeRow[race_type_id]' and race_class = '$_GET[class]' and d.Licence_No = r.driver_id and r.position >0 order by r.position asc";
                            $result = mysqli_query($conn, $sql);
                   
                }
               
                
                
               echo "<div class=\"table\"> <div class=\"row\">" ."<h1 class=\"tableHeader " .$className['css'] ."\">". $className['class_name']. "  Race Number ". $rNum ."</h1></div><div class=\"row\"> <div class =\"position\"><p>  </p></div><div class=\"name\"><p>Name</p></div><div class=\"points\"><p>Position</p></div></div>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class=\"row\"> <div class =\"position\"><p> " . "<img src =\"images/profile.jpg\"> ". "</p></div> " . "<div class=\"name\"><p>". $row['Name']. "</p></div><div class=\"points\"><p>"  . " " .$row['position']."</p></div></div>";

                }
                echo "</div>";
                
            }
            
         
         
         ?>
                
    </div>
</body>
</html>