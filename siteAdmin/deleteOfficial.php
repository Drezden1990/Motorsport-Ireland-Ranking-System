<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Delete Official </title>
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
            <h3>Delete Race Official</h3>
        </div>
        <div class="mainForm">
        <form action="deleteOfficial.php" method="post">

        <p class="detail">Search by ID Number:</p>
        <p class="userInput"><input  type="text" name="id"></p><br><br>
        
        
        <input  class="submit" type="submit" value="Search"><br><br>
         <?php
            if(isset($_POST['id'])){
                $officialInfo = "SELECT * From official where id= '$_POST[id]'";
                $result1 = mysqli_query($conn, $officialInfo);
                $row1 = mysqli_fetch_assoc($result1);
                if(!$row1){
                    echo "Error: No matching race official found";
                }
                else{
                    echo "<p class=\"detail\">Name:</p><p class=\"userInput\"> " . $row1['fname'] . " " . $row1['lname']."</p>";
                }
                
            }
        ?>
        
       
        </form>
           <form action="../phpScripts/deleteOfficialScript.php" method="post">
                <input hidden type="text" name="id" value= <?php echo "\"". $_POST['id']."\"";?> >
                <input class="submit" <?php if(!isset($_POST['id']) or !$row1){echo "hidden";}?> type="submit" value=<?php if(isset($_POST['id'])){echo "\"Delete\"";}?> >
            </form>
        </div>
                                           <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>

        </div>

</body>
</html>