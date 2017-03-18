<?php

	class DBReader {
		private $servername = "localhost";
		private $username = "root";			// Login credentials
		private $password = "q6ib8j2x";	
		private $dbname = "tmp";
		private $conn;
		
		private $leaderboard  = array();
		
		
		function __construct() {
			$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
			
			if (!$this->conn) {
				die("Connection failed!! " . mysqli_connect_error());
			} 
			
		}
		
		// *** This rade id is obtained when a NEW race is added, not when a race is modified ****
		// A race's id will be 1 plus the most recent (or max) race_id in the table
		// if no race result exists, race id will be 1.	
		function getRaceID() {
			$sqlQuery = "SELECT MAX(race_num) FROM results";
			
			if ($result=mysqli_query($this->conn,$sqlQuery))
			{
				// Fetch one and one row
				$row=mysqli_fetch_row($result);
				
					if ($row[0] == null)
						return 1;
					else
						return $row[0] + 1;
				
				// Free result set
				mysqli_free_result($result);
			}
			
		}
		
		
		// checks to see if all drivers in a given results collection 
		// exist in the database
		function verifyAllDriversExists($resultsCollection) {
			for ($i = 0; $i < sizeof($resultsCollection); $i++ ) {
				$raceResult = $resultsCollection[$i];
				$len = $raceResult->resultsLen();
				$fileLocation = $raceResult->getFileLocation();
			
				for ($z = 0; $z < $len - 1;$z++) {
						
					$driverRes = $raceResult->getDriverResult($z);
					
					$dbError = $this->driverExists($driverRes, $fileLocation);
					
					if ($dbError != 1)
						return $dbError;
				}
			
			}	
			return true;
		}
		
		
		
		// checks to see if a driver is in the driver's database table 
		function driverExists($driverResult, $fileLocation) {
			$sqlQuery = "SELECT Name, Licence_No, Registered FROM driver WHERE Licence_No = ";
			$id = $driverResult->getDriverID();
			$sqlQuery .= "'". $id . "';";
				
			
			if ($result=mysqli_query($this->conn,$sqlQuery))
			{
				// Fetch one and one row
				$row=mysqli_fetch_row($result);
			
				if ($row[1] == $id && $row[2] == 1) {
					return true;
				}
				else
					return "Driver does not exist in database or is not registered!" ."<br><br>" . "Driver Name: " . 	$driverResult->getDriverName() . "<br>" .
						"Driver ID: " . $driverResult->getDriverID() . "<br>File: " . $fileLocation . "<br><br>";
			}
		
		}
		
		
		
		// writes a whole set of driver results (enclosed in race results objects) to the database
		function writeRacesToDB($resultsCollection, $raceID) {
			for ($i = 0; $i < sizeof($resultsCollection); $i++ ) {
				
				$raceResult = $resultsCollection[$i];
				$raceType = $raceResult->getRaceType();
				$len = $raceResult->resultsLen();
					
				for ($z = 0; $z < $len - 1;$z++) {
					$driverRes = $raceResult->getDriverResult($z);
						
					$dbError = $this->writeDriverResultToDB($driverRes, $raceType, $raceID);
						
					if ($dbError != 1)
						return $dbError;
				}	
			}
			
			return true;
				
		}
		
		
		
		// writes a single driver result to the database
		function writeDriverResultToDB($driverResult, $raceType, $raceID) {
			$licence_No = $driverResult->getDriverID();
			$driverResult->convertClassNametoID();
			$classID = $driverResult->getDriverClassID();
			$pos = $driverResult->getPosition();
			
			if ($pos == "DNF" || $pos == "dnf" || $pos == "dns" || $pos == "DNS" )
				$pos = -1;
			
			$sql = "INSERT INTO `results`(`race_num`, `race_type_id`, `race_class`, `driver_id`, `position`)
				VALUES (". $raceID . ", " . $raceType . ", " . $classID .  ", '" . $licence_No . "', "  
						. $pos . ");";
				
			if (!mysqli_query($this->conn, $sql)) {
				return "Error: " . $sql . "<br>" . mysqli_error($this->conn). "<br><br>";
			}
			
			return true;
		
		}
		
		
		// calculates the rankings for all driver classes
		function calculateRankings() {
			
			$sql = "DELETE FROM `leaderboard`;";		// clears out the current rankings
				
			if ($this->conn->query($sql) == false) {
				return "Error deleting table: " . $this->conn->error . "<br>";
			}
			
            
			for ( $i = 1; $i <= 9; $i++ ) {			// calculates new rankings for each class based on race table
				
				$this->leaderboard =  array();
				
				$this->makeRankingsForClassPres($i);
				$this->makeRankingsForClassFinals($i);
                
                $this->printLeaderboard();
				
				$this->updateLeaderboardInDB();				
			}
				
			
		}
		
		// get all of the driver results for a class which are of race type, pre-final
		// then, calculate the results for each of those drivers based on their final positions in all of the races
		function makeRankingsForClassPres($num) {
			$sqlQuery = "SELECT * FROM `results` WHERE race_class = " . $num . " AND ". 
				"race_type_id = 1";
				
	
			if ($result=mysqli_query($this->conn,$sqlQuery))
			{
				while ($obj=mysqli_fetch_object($result))
				{
                    
					$driverResult = new DriverResult($obj->driver_id, $obj->position, "", $obj->race_class );
                    $this->calculatePreResult( $driverResult);
				}
				// Free result set
				mysqli_free_result($result);
			}else {
				return "<br>Error: " . $sql . "<br>" . mysqli_error($this->conn);
			}
		
		}
		
		// adds up all the pre-final results for a driver
		function calculatePreResult($driverResult) {
			$position = $driverResult->getPosition();
			
			if ($position != -1)					
				$score = 34 - ($position - 1); 
			else 								// for drivers who didn't finish the race, 0 score
				$score = 0;
			
		
			if (sizeOf($this->leaderboard) != null) {
				$index = $this->driverResExistsAlready($this->leaderboard, $driverResult);
			}else 
				$index = -1;
			
			
			if ($index != -1) {							 // driver result is in the array already, add to the current total
				$this->leaderboard[$index]->incPoints($score);
		
			} else { 									// driver result is not in the array, add it to the array and set it's current total points
				$driverResult->setTotalPoints($score);
				$this->leaderboard [] = $driverResult;
			}
			
			
			return $this->leaderboard;
		}
		
		
		
		// check to see if the driver has already been entered into the leaderboard array
		function driverResExistsAlready($array, $driverResult) {
			
			for ($i = 0; $i < sizeof($array); $i++) {
				$licenceNum1 = $driverResult->getDriverID();
				$res = $array[$i];
				$licenceNum2 = $res->getDriverID();
								
				if ($licenceNum1 == $licenceNum2)
					return $i;
			}
			
			return -1;
		}
		
		
		// get all of the driver results for a class which are of race type, final
		// then, calculate the results for each of those drivers based on their final positions in all of the races
		function makeRankingsForClassFinals($num) {
			
			$sqlQuery = "SELECT * FROM `results` WHERE race_class = " . $num . " AND ".
					"race_type_id = 2";
			
			
			if ($result=mysqli_query($this->conn,$sqlQuery))
			{
				while ($obj=mysqli_fetch_object($result))
				{
			
					$driverResult = new DriverResult($obj->driver_id, $obj->position, "", $obj->race_class );
					$this->calculateFinalsResult($driverResult);
				}
				// Free result set
				mysqli_free_result($result);
			}else {
				return "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
		
		
		// adds up all the final results for a driver
		function calculateFinalsResult($driverResult) {
			$score;
			$position = $driverResult->getPosition();
		
			if ($position == 1)
				$score = 55;
			else if ($position == 2)
				$score = 52;
			else if ($position == 3)
				$score = 50;
			else if ($position == -1)		// drivers who didn't complete the race
				$score = 0;
			else 
				$score = 50 - ($position - 3);
				
						
			$index = $this->driverResExistsAlready($this->leaderboard, $driverResult);
					
			if ($index != -1) { 								// driver result is in the array, increase driver's score based on position
				$this->leaderboard[$index]->incPoints($score);
			} else { 											// driver result is not in the array, add to leaderboard array and set score for driver
				$driverResult->setTotalPoints($score);
				$this->leaderboard[] = $driverResult;
				
			}
				
			return $this->leaderboard;
		}
		

		// inserts the newly updated rankings into the leaderboard in the database
		public function updateLeaderboardInDB() {
			
			for ($i = 0; $i < sizeof($this->leaderboard); $i++) {
				$driverResult = $this->leaderboard[$i];
				
				$licence_num = $driverResult->getDriverID();
				$classID = $driverResult->getDriverClassID();
				$points = $driverResult->getPoints();
				
				
				$sql = "INSERT INTO `leaderboard`(`Licence_No`, `Class_ID`, `Points`) VALUES ('".
						$licence_num . "', ". $classID. ", ". $points . ");";
				

				if (!mysqli_query($this->conn, $sql)) {
					return "Error: " . $sql . "<br>" . mysqli_error($this->conn). "<br><br>";
				}
					
			}
			
		}
		
		
		// removes all driver results from the race result table with the given race id
		public function removeRaceResults($raceID) {
			$sql =  "DELETE FROM `results` WHERE race_num =" .  $raceID;
			
			if (!mysqli_query($this->conn, $sql)) {
				return "Error Deleting Race Result: " . $sql . "<br>" . mysqli_error($this->conn). "<br><br>";
			}
		}
		
		
		// method used for debugging.
		public function printLeaderboard() {
			echo "<pre>     ID         Points</pre>";
				
			for ($i = 0; $i < sizeof($this->leaderboard); $i++) {
				$driverResult = $this->leaderboard[$i];
		
				$points = $driverResult->getPoints();
				$id = $driverResult->getDriverID();
		
				echo "<pre>  ", $id, "       ", $points, "</pre>";
			}
		}
	
				
	}
?>