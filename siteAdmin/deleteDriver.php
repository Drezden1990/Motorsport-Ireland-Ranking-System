<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Delete Driver </title>
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
             <?php
                $url = $_SERVER['REQUEST_URI'];
                if (strpos($url, 'message=success') !== false){
                    echo "<br>Driver rcords deleted";
                }
                 else if (strpos($url, 'error=incorrect') !== false){
                    echo "<br>An error occurred";
                }
               
                
            ?>
        <div class="forms">
        <div class="formHead">
            <h3>Delete Driver</h3>
        </div>
        <div class="mainForm">
        <form action="deleteDriver.php" method="post">

        <p class="detail">Search by Driver Number:</p>
        <p class="userInput"><input  name="driver_id"></p>
        
        </select><br><br>
        <input class="submit" type="submit" value="Search"><br><br>
         <?php
            if(isset($_POST['driver_id'])){
                $driverInfo = "SELECT * From driver where Licence_No = '$_POST[driver_id]'";
                $result1 = mysqli_query($conn, $driverInfo);
                $row1 = mysqli_fetch_assoc($result1);
                $class = "SELECT class_name from class where class_id = '$row1[Class_ID]'";
                $result2 = mysqli_query($conn, $class);
                $row2 = mysqli_fetch_assoc($result2);
                if(!$row1){
                    echo "Error: No matching driver";
                }
                else{
                    echo "<p class=\"detail\">Driver Name: </p><p class=\"userInput\">" . $row1['Name'] . "</p><br><br>" ;
                    echo "<p class=\"detail\">Class: </p><p class=\"userInput\">". $row2['class_name'] . "</p><br><br>" ; 
                }
                
            }
        ?>
        
       
        </form>
           <form action="../phpScripts/deleteDriverScript.php" method="post">
                <input hidden type="text" name="licence_no" value= <?php echo "\"". $_POST['driver_id']."\"";?> >
                <input class="submit" <?php if(!isset($_POST['driver_id']) or !$row1){echo "hidden";}?> type="submit" value=<?php if(isset($_POST['driver_id'])){echo "\"Delete Driver\"";}?> >
            </form>
        </div>
        </div>

</body>
</html>