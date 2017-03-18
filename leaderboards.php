<?php
    session_start();
    include 'phpScripts/dbconn.php';


    include 'phpScripts/getDriverInfo.php';
    include 'phpScripts/getNextRace.php';
    
  
    
?>
<!DOCTYPE html>
<html>
<head>
    <title> Leaderboard </title>
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
        
        <h1 class="profileHeader"> LeaderBoards</h1>
        <div class="leaderboard">
        <form action="leaderboards.php" method="get">
        <p class="detail"> Select a class</p>
        <p class="userInput"><select name="class">
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
                $sql = "SELECT  l.Licence_No, l.Points, d.Name from leaderboard l, driver d  WHERE l.Class_ID = '$_GET[class]' and d.Licence_no = l.Licence_No order by Points desc";
                $result = mysqli_query($conn, $sql);
                $i = 1;
                $getclass = "SELECT * from class where class_id = '$_GET[class]'";
                $getResult = mysqli_query($conn, $getclass);
                $className = mysqli_fetch_assoc($getResult);
               echo "<div class=\"table\"> <div class=\"row\">" ."<h1 class=\"tableHeader " .$className['css'] ."\">". $className['class_name'] ."</h1></div><div class=\"row\"> <div class =\"position\"><p> Position </p></div><div class=\"name\"><p>Name</p></div><div class=\"points\"><p>Points</p></div></div>";
                while($row = mysqli_fetch_assoc($result)){
                    echo "<div class=\"row\"> <div class =\"position\"><p> " . $i . "</p></div> " . "<div class=\"name\"><p>". $row['Name']. "</p></div><div class=\"points\"><p>"  . " " .$row['Points']."</p></div></div>";
                    $i = $i+1;
                }
                echo "</div>";
                
            }
            
         
         
         ?>
                
    </div>
</body>
</html>