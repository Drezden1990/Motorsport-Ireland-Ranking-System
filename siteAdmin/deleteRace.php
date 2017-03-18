<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Delete Race </title>
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
<h4>Delete a Race</h4>
</div>      
<div class="mainForm">
<form action="deleteRace.php" method="post">

            <p class="detail">Choose a race to delete:</p> <p class="userInput"> 
            <select name="race_number">
            <?php
                    $str1 = "<option value=\"";
                    $str2 = "\">";
                    
                        $getRaces = "SELECT race_number from race where race_type = 1 order by race_number asc";
                        $result = mysqli_query($conn, $getRaces);

                    while($row = mysqli_fetch_assoc($result)){
                        echo ($str1).$row['race_number']. ($str2) . "Race " .$row['race_number'] .$row['town']. "</option>";
                }
                ?>
</select></p><br><br>
<input  type="submit" value="Search" class="submit">

                    <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>


<?php
    if(isset($_POST['race_number'])){
        $raceLocation = "SELECT t.town, r.race_number FROM track t,race r WHERE r.race_number = '$_POST[race_number]' limit 1";
        $dates = "SELECT r.date, r.race_type, t.type_meaning from race r, race_type t where (r.race_type = t.race_type) and r.race_number = '$_POST[race_number]' order by date asc";
        $result1 = mysqli_query($conn, $raceLocation);
        $result2 = mysqli_query($conn, $dates);
        $row1 = mysqli_fetch_assoc($result1);
        echo "<br><br><br><p class=\"detail\">Race Number:</p> <p class=\"userInput\">  " . $_POST['race_number'] . "</p><br>" ;
        echo "<p class=\"detail\">Location:</p> <p class=\"userInput\">  " .$row1['town'] . "</p><br>" ;
         while($row2 = mysqli_fetch_assoc($result2)){
            echo "<br><p class=\"detail\">" . $row2['type_meaning'] .": </p> <p class=\"userInput\"> ". $row2['date'] ."</p>" ;
        }
       
    }
?>
</form>
</div>

   <form class="mainForm" action="../phpScripts/deleteRaceScript.php" method="post">
        <input hidden type="text" name="race_number" value= <?php echo "\"". $_POST['race_number']."\"";?> >
        <input class="submit"<?php if(!isset($_POST['race_number'])){echo "hidden";}?> type="submit" value=<?php if(isset($_POST['race_number'])){echo "\"Delete\"";}?> >
    </form>
</body>
</html>