<?php
	
	include_once 'CSVReader.php';
	include_once 'DriverResult.php';
	include_once 'RaceResults.php';
	include_once 'DBReader.php';
	
	session_start();
    $success = "Races results uploaded successfully";
	
	$system = new MI_System();		// create a MI_System
	
	
	if(isset($_POST['race_number'])){					// if the race number is set, run the modify version of main()
		$system->replaceRacesMain($_POST['race_number']);
	} else 
		$system->main();								// if the race number is not set, run the regular version of main()
	
		
	
	class MI_System {
		private $resultsCollection = array();
		
	
		public function main() {
			$dbReader = new DBReader();
			$continueProgram = true;
			
		
			$raceID = $dbReader->getRaceID();		// gets the  race id for this set of races
		
			$continueProgram = $this->storeResultsCSVFolders(); 		
						
			if ($continueProgram == 1) {											// if no error exists, continue with DB operations
				$dbError = $this->moveResultsToDB($dbReader, $raceID, true);	
				
				if ($dbError != 1) {												// if a db error exists return it to the website and exit
					$this->returnErrorMsg($dbError);
					exit();
				}
				$dbReader->calculateRankings();
				
			}  else 																// csv error exists, return it to the website for display
				$this->returnErrorMsg($continueProgram);
			
			header ("Location: ../siteAdmin/uploadRaceResults.php?message=Results uploaded successfully");
		
			
		}
		
		

		// main method for replacing a race result
		// replaces the race with the id given with a new set of uploaded results in csv files
		public function replaceRacesMain($raceID) {
			$continueProgram = true;
			$dbReader = new DBReader();
		
			
			$continueProgram = $this->storeResultsCSVFolders();
			
			
			if ($continueProgram == 1) {													// if no error exists, continue with DB operations
              
				$dbError = $this->moveResultsToDB($dbReader, $raceID, false);
				
                
				if ($dbError != 1) {														// if a db error exists return it to the website and exit
					$this->returnErrorMsg($dbError);
					exit();
				}
				
				$dbReader->calculateRankings();
			} else																		// csv error exists, return it to the website for display
				$this->returnErrorMsg($continueProgram);
				
			header ("Location: ../siteAdmin/uploadRaceResults.php?message=Results uploaded successfully");
            
			exit();
			
		}
		
		
		
		
		public function storeResultsCSVFolders() {
            
            
			// read from pre-finals folder
			$csvLocations = $this->getCSVLocations(MI_System::PRE_FINAL);  // stores the locations of each of the csv files in the folder
     
			// store any error returned from reading csv's
			$continueMethod = $this->getRaceResultsFromCSVs($csvLocations, MI_System::PRE_FINAL );
			
            
    				
			if ($continueMethod != 1)  { 		// if there's any error return to main with that error
				return $continueMethod;
			}
				

			// read from finals folder
			$csvLocations = $this->getCSVLocations(MI_System::FINALS);  // stores the locations of each of the csv files in the folder
			// store any error returned from reading csv's
			$continueMethod = $this->getRaceResultsFromCSVs($csvLocations, MI_System::FINALS );
			
              
            
			
			if ($continueMethod != 1)  { 	// if there's any error return to main with that error
				return $continueMethod;
			}
			
			return true;
			
		}
		
		
		// reads and stores the locations of all the CSV files from a directory
		// reads either from the "finals" directory or the "pre-finals" directory
		public function getCSVLocations($raceType) {
			$csvLocations =  array();
            
			
			if ($raceType == MI_System::PRE_FINAL)		
				$directory = "/var/www/example.com/public_html/pre_final/";  // directory for pre final races
			else 					
				$directory = "/var/www/example.com/public_html/final/"; // directory for final races
		
			
			foreach (glob($directory . "*.csv") as $filename) { // get and store and file names in directory
				$csvLocations[] = $filename;
			}
		
			return $csvLocations;
		}
		
		
		// gets all the race results (which are a collection of driver results) from the csvs
		// and stores them in resultsCollection array
		public function getRaceResultsFromCSVs($csvFiles, $raceType) {
			
						
			for ($i = 0; $i < sizeof($csvFiles); $i++) {
				$fileLocation =  $csvFiles[$i];
				$csvReader = new CSVReader($fileLocation, $raceType);
						
				$errorMsg = $csvReader->storeAndCheckRaceResults(); 
									
				if ($errorMsg != 1)  {
					return $errorMsg . $fileLocation;
				}
				
				$this->resultsCollection[] = $csvReader->getRaceResultsObj();			
			}
			
			return true;
			
		}
		
		// moves all race results to the db after verifying all drivers in the csv files
		// exist on the database drivers table and are registered
		public function moveResultsToDB($dbReader, $raceID, $addOrModify) {
			$dbError = $dbReader->verifyAllDriversExists($this->resultsCollection);	
            
            echo "DB Error (in write to DB): ", $dbError, "<br>";
			
			if ($dbError != 1)
				return $dbError;
			
			
			if ($addOrModify != 1)
				$dbReader->removeRaceResults($raceID); // removes a race result so it can be replaced       
			
			return $dbReader->writeRacesToDB($this->resultsCollection, $raceID);
		}
		
		
		// when any error occurs, this method sends the error back to the calling script to be displayed
		public function returnErrorMsg($msg) {
			header ("Location: ../siteAdmin/uploadRaceResults.php?error='$msg'");
			exit();
		}
		
        const PRE_FINAL = 1;
        const FINALS = 2;
	
	}

?>