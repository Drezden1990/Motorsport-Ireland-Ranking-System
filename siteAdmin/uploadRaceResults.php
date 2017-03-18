<?php
    session_start();
    include '../phpScripts/dbconn.php';
?>

<!doctype html>
<html>

<head>
    <title> Upload Race Results</title>
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
            <?php
            $url = $_SERVER['REQUEST_URI'];
            if (strpos($url, 'update') == true){
                $header = "Update ";
            }
            else {
                $header = "Upload New ";
            }
                
            ?>
            
          
                <h3><?php echo $header; ?>Race Results</h3>
            </div>
            <div class="mainForm">
                <form action="../phpScripts/uploadResults.php" method="post" enctype="multipart/form-data">

                <p class="detail">Choose a race:</p> <p class="userInput"><select name="race_number">
                    <?php
                        $str1 = "<option value=\"";
                        $str2 = "\">";
           
                        $url = $_SERVER['REQUEST_URI'];
                        if (strpos($url, 'update') == true){
                            //only show races which have results uploaded already
                            $getRaces = "SELECT r.race_number, t.town FROM race r, track t where race_type = 1 and r.track_no = t.track_id and r.race_number in (select race_num from results)";
                            $result = mysqli_query($conn, $getRaces);
                        }
                        else{
                            //only show races with no results uploaded already
                            $getRaces = "SELECT r.race_number, t.town FROM race r, track t where race_type = 1 and r.track_no = t.track_id and r.race_number not in (select race_num from results)";
                            $result = mysqli_query($conn, $getRaces);
                        }
            
                        while($row = mysqli_fetch_assoc($result)){
                            echo ($str1).$row['race_number']. ($str2) . "Race " .$row['race_number']. ": " .$row['town']. "</option>";
                    }
                    ?>
                </select></p><br><br>
                
                   <p class="detail"> Upload Pre Final Results:</p> <br><p class="detail">
                    <input type="file"  multiple="multiple" name="preFinals[]" id="fileToUpload"></p><br><br>
                 
                   <p class="detail"> Upload Final Results:</p> <br><p class="detail">
                    <input type="file"  multiple="multiple" name="finals[]" id="fileToUpload"></p><br><br>
             
                 
                    <input class="submit" type="submit" value="Upload Files" name="submit">
                    
                    <p class="messages"><?php if(isset($_GET['error'])){echo $_GET['error'];} else if (isset($_GET['message'])){echo $_GET['message'];} ?></p>
             

            </div>
                </form>
        </div>
        
    </div> <!-- end of container -->
</body>
</html>