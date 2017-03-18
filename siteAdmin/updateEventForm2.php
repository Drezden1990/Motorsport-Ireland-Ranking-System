<?php
    session_start();
    include '../phpScripts/dbconn.php';   
?>
<!doctype html>
<head>
    <title> Update Race</title>
    <meta charset = "UTF-8" />
    <meta name ="keywords" content = "KARTING, KARTING IRELAND, MOTORSPORT, MOTORSPORT IRELAND, KART, KARTS, RACING" />
    <link rel="stylesheet" href="../index.css"> 



</head>


<body>
    <div class="container"> <!-- frame page -->
        <div class="top">
            <img class="logo" src="../images/Motorsport_Ireland_white_text.png" />
        </div>
        <div class="nav"> <!-- Nav Bar -->
            <ul>
                <li><a href="../index.php">Home</li></a>
                <li><a href="../technical.php">Technical</li></a>
                <li><a href="../regulations.php">Regulations</li></a>
                <li><a href="../leaderboards.php">Leaderboards</li></a>
                <li><a href="/phpScripts/loginHandler.php">Your Profile</li></a>

            </ul>
        </div> <!-- End of Nav -->
        <div class="forms">
        <div class="formHead">
            <h3>Update Race Details</h3>
        </div>
        <div class="mainForm">
        <form action="../phpScripts/updateEvent.php" method="post">
         <?php
                $url = $_SERVER['REQUEST_URI'];
                if (strpos($url, 'message=success') !== false){
                    echo "Race details successfully changed";
                }
                
                
            ?>

        <p class="detail">Race number:</p><p class="userInput"> <?php  if(!isset($_GET['race_number'])){echo $_POST['race_number'];} else {echo $_GET['race_number'];} ?> </p><br>
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
        </select></p><br><br>

        <p class="detail">Heat 1: </p><p class="userInput"><input type="date" name="h1Date"><br><br></p>
        <p class="detail">Heat 2: </p><p class="userInput"><input type="date" name="h2Date"><br><br></p>
        <p class="detail"> Pre Final: </p><p class="userInput"><input type="date" name="preDate"><br><br></p>
        <p class="detail"> Final:</p><p class="userInput"> <input type="date" name="finalDate"><br><br></p>
        
                <input hidden type="text" name="race_number" value="  <?php  if(!isset($_GET['race_number'])){echo $_POST['race_number'] . "\"";} else {echo $_GET['race_number']. "\"";} ?> >
                <input class="submit" type="submit" value="Update race">
            </form>
         <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>

        </div>
        </div>

</body>
</html>