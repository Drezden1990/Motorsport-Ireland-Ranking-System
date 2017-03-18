<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Add race </title>
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
    <div class ="formHead">
        <h3>Add Race</h3>
    </div>
    <div class="mainForm">
        <form action="../phpScripts/newEvent.php" method="post" >
                
    
        <p class="detail">Race number:</p> <p class="userInput"><input type="text" name="race_number" value= <?php echo "\"". $_POST['race_number']."\"";?>></p><br><br>
        <p class="detail">Location:</p>
        <p class="userInput"><select name="track_id">
        <?php
            $str1 = "<option value=\"";
            $str2 = "\">";
            
            $getTrack = "SELECT * FROM track";
            $result = mysqli_query($conn, $getTrack);

            while($row = mysqli_fetch_assoc($result)){
                echo ($str1).$row['track_id']. ($str2)  .$row['town']. "</option>";
        }
        ?>
        </select></span><br><br>

        <p class="detail">Heat 1:</p> <p class="userInput"> <input type="date" name="h1Date"></p><br><br>
        <p class="detail">Heat 2: </p> <p class="userInput"><input type="date" name="h2Date"></p><br><br>
        <p class="detail">Pre Final: </p> <p class="userInput"><input type="date" name="preDate"></p><br><br>
        <p class="detail">Final: </p> <p class="userInput"><input type="date" name="finalDate"></p><br><br>


        <input type="submit" value="Add Race" class="submit">
        </form>
        <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>
    </div>

</div>
</body?
</html>