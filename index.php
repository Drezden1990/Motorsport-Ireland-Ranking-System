<?php
    session_start();
    include 'phpScripts/dbconn.php';
    include 'phpScripts/getNextRace.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset = "UTF-8" />
    <meta name ="keywords" content = "KARTING, KARTING IRELAND, MOTORSPORT, MOTORSPORT IRELAND, KART, KARTS, RACING" />
    <link rel="stylesheet" href="index.css"> 



</head>


<body>
    <div class="container"> <!-- frame page -->
        <div class="top">
        <img class="logo" src="images/Motorsport_Ireland_white_text.png" />
        <form <?php if(!isset($_SESSION['id'])){ echo "class=\"login\"";} else {echo "hidden";} ?> action ="phpScripts/login.php" method="post">
           <span class="loginInput" > Username: <input type="text" name="user_id" class="loginInput"> </span>
           <span class="loginInput"> Password:  <input type="password" name="pw"  class="loginInput"> </span>

           
           <span class="loginInput"><p style="color:grey"> .    </p> <input type="submit" value="Login"  class="loginButton" > </span>
         </form>
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
          </div> <!-- End of Nav -->
          
          <div class="imageSlider">
            <img src="images/2.jpg" class="sliderImage"/>
          </div>
          
       

           <div class="informationHolder"> <!-- race -->
            <div>
                <h2 class="classHeading" style="background-color:red; border: 2px solid black;">Race Information</h2>
            </div>
            <div  class="raceInfo">
                <h3> Upcoming  Event </h3>

                <?php 
                    echo "<p class=\"raceDetails\"> Race Number: " . $raceRow['race_number'] . "</h4><br>";
                    echo "<p class=\"raceDetails\"> Location: " . $town['town'] . "</h4><br>";
                    while ( $infoRow = mysqli_fetch_array( $result2 ) ){
                        echo "<p class=\"raceDetails\">" . $infoRow['type_meaning'].": ". $infoRow['date'] . "</h4><br>";
                    }  
                ?>
            </div><!-- End of upcoming -->
            <a href="http://www.123contactform.com/form-2390106/MI-Karting-2017-Race-Number-Registration"><div class="raceInfo"> <!-- Register -->
                <h3> Register Here</h3>
                 <img src="images/signup.jpg" />
            </div></a> <!-- end of Register -->           

        </div> <!-- end of race Info --> 
        
        <div class="informationHolder"> <!-- juniorMax -->
        
            <div>
                <h2 class="classHeading juniorMax">Junior Max</h2>
            </div>
            <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"><div class="juniorMax information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

            <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class="juniorMax information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

            <a href="viewResults.php?class=1"><div class="juniorMax information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div></a> <!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=1"><div class="juniorMax information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div> </a><!-- end of leaderBoard -->

        </div> <!-- End of juniorMaxes -->
          
          
        <div class="informationHolder"> <!-- KZ2 -->
            <div>
                <h2 class="classHeading KZ2">KZ2</h2>
            </div>
            <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"><div class="KZ2 information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

             <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class="KZ2 information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

            <a href="viewResults.php?class=2"> <div class="KZ2 information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div> </a><!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=2"><div class="KZ2 information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div></a> <!-- end of leaderBoard -->

        </div> <!-- End of KZ2es -->
        
        
       <div class="informationHolder"> <!-- IAME miniMax -->
            <div>
                <h2 class="classHeading miniMax">IAME MiniMax</h2>
            </div>
            <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"><div class="miniMax information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

             <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class="miniMax information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

             <a href="viewResults.php?class=3"><div class="miniMax information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div></a> <!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=3"><div class="miniMax information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div><a> <!-- end of leaderBoard -->

        </div> <!-- End of miniMaxs -->
          
          
          
       <div class="informationHolder"> <!-- IAME cadet -->
           <div>
                <h2 class="classHeading cadet">IAME Cadet</h2>
            </div>
           <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"> <div class="information cadet"> <!-- technical -->
                <h3> Technical <br>Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

             <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class=" information cadet"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

            <a href="viewResults.php?class=4"> <div class="cadet information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div></a> <!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=4"><div class="cadet information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div> </a><!-- end of leaderBoard -->

       </div> <!-- End of Cadets -->    
       
       
       <div class="informationHolder"> <!-- seniorMax -->
            <div>
                <h2 class="classHeading seniorMax">Senior Max</h2>
            </div>
           <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"> <div class="seniorMax information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

             <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class="seniorMax information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

             <a href="viewResults.php?class=5"><div class="seniorMax information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div> </a><!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=5"><div class="seniorMax information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div> </a><!-- end of leaderBoard -->

        </div> <!-- End of seniorMaxes -->

        <div class="informationHolder"> <!-- biland -->
            <div>
                <h2 class="classHeading biland">Biland</h2>
            </div>
            <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"><div class="biland information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>
            
             <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class="biland information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

             <a href="viewResults.php?class=6"><div class="biland information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div> </a><!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=6"><div class="biland information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div> <!-- end of leaderBoard --></a>

        </div> <!-- End of bilands -->
        
                <div class="informationHolder"> <!-- open125 -->
            <div>
                <h2 class="classHeading open125">Open Class 125</h2>
            </div>
            <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"><div class="open125 information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

             <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"><div class="open125 information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

             <a href="viewResults.php?class=7"><div class="open125 information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div> </a><!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=7"><div class="open125 information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div> </a><!-- end of leaderBoard -->

        </div> <!-- End of open125s -->
        
                <div class="informationHolder"> <!-- x30J -->
            <div>
                <h2 class="classHeading x30J">IAME X30 Junior</h2>
            </div>
           <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"> <div class="x30J information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

            <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"> <div class="x30J information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

             <a href="viewResults.php?class=8"><div class="x30J information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div> </a><!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=8"><div class="x30J information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div></a> <!-- end of leaderBoard -->

        </div> <!-- End of x30Js -->
        
                <div class="informationHolder"> <!-- x30S -->
            <div>
                <h2 class="classHeading x30S">IAME X30 Senior</h2>
            </div>
            <a href="Tech&Sporting/iameparillagazelle60cc-MIcadet.pdf"><div class="x30S information"> <!-- technical -->
                <h3> Technical<br> Information </h3>
                <img src="images/cog.png" class="infoImage"/>
            </div><!-- End of technical --></a>

            <a href="Tech&Sporting/IAME-MINI-X30-MI-2016-Pagina-Aggiuntiva-CURVA-SCARICO-O23.4mm.pdf"> <div class="x30S information"> <!-- Sporting -->
                <h3> Sporting<br> Regulations </h3>
                 <img src="images/sporting.png" class="infoImage" />
            </div> <!-- end of Sporting --></a>

             <a href="viewResults.php?class=9"><div class="x30S information"> <!-- Results -->
                <h3> Results </h3>
                 <img src="images/results.png" class="infoImage"/>
            </div> </a><!-- end of Results -->

            <a href="http://www.ca326motorsport.com/leaderboards.php?class=9"><div class="x30S information"> <!-- Leaderboard -->
                <h3> Leaderboard </h3>
                 <img src="images/leaderboard.png" class="infoImage" />
            </div> </a><!-- end of leaderBoard -->

        </div> <!-- End of x30Ss -->








    </div> <!-- End of container -->

</body>
</html>
