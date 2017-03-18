<?php
	//include_once 'DriverResult.php';
	include_once 'RaceResults.php';


	class CSVReader {
		private $csvRows = array();
		private $raceResults;
		
		
		
		function __construct($fileLocation, $raceType) {
			$this->raceResults = new RaceResults($fileLocation,$raceType );
		}
		
		
		
		// gets all results from a csv and checks to see if they contain any errors
		public function storeAndCheckRaceResults() {
			$fileLocation = $this->raceResults->getFileLocation();
			
			if ($this->readFromCSV($fileLocation) == false)
				return "Error reading from csv file at location: ";
		
			$this->makeDriverList();
			
			$errorMsg = $this->errorCheckAllResults();
				
			
			if ($errorMsg != 1) {	// return the error msg if one has occurred 
				return $errorMsg;
			}	
		
			return true; 
		}
		
		
		// reads from a csv and stores the resulting lines in csvRows for processing
		public function readFromCSV($csvFileLocation) {
			$headerLine = true;
			$fileHandle = fopen($csvFileLocation, "r");
			
			if ($fileHandle == 0) {
                echo "file could not be opened", "<br>";
				return false;
            }
			
			while (!feof($fileHandle)) {
				
				if ($headerLine == true) { // header line is not wanted
					fgetcsv($fileHandle);
					$headerLine = false;
				} else
					$this->csvRows[] = fgetcsv($fileHandle);
			}
			
			return true;
			
		}
		
				
		// take the wanted columns with pertinent driver result information and 
		// stores them in a race result array
		public function makeDriverList() {
			
			for ($i = 0; $i < sizeof($this->csvRows); $i++) {
				$driverID = $this->csvRows[$i][10];
				$position = $this->csvRows[$i][0];
				$name = $this->csvRows[$i][2];
				$driverClass = $this->csvRows[$i][3];
				
				$this->raceResults->addDriverResult(new DriverResult($driverID, $position, $name, $driverClass));
			}
			
		}
		
		
		// error checks all race results
		public function errorCheckAllResults() {
			$len = $this->raceResults->resultsLen();
			
			for ($i = 0; $i < $len - 1; $i++) {
		
				$driverRes = $this->raceResults->getDriverResult($i);
		
				$check = $this->errorCheckOneResult($driverRes);
					
				if ($check == 1) {
					return $this->errorMessage($driverRes, 1);
				} else if ($check == 2) {
					return $this->errorMessage($driverRes, 2);
				} else if ($check == 3)
					return $this->errorMessage($driverRes, 3);
			}
			return true;
		}
		
		
		
		// error checks a specific race result
		public function errorCheckOneResult($driverResult) {
		
			$validID = $this->isValidIDNum($driverResult->getDriverID());
			$validClass = $this->isValidClass($driverResult->getDriverClassID());
			$validPosition = $this->isValidPosition($driverResult->getPosition());
			 
			 if ($validPosition && $validID && $validClass) { // correctly entered result
			 	return 0;
			 }else {
			 	if ($validID == false)	// invalid ID entered
			 		return 1;
			 	else if ($validClass == false) // invalid class entered
			 		return 2;
			 	else
			 		return 3; // invalid position
			 }
			 
		}
		
		// verifies the validity of an entered id number
		// all id numbers must be 8 characters long, with the first characters, letters and then last six digits
		public function isValidIDNum ($idNum){
			$countryCode = substr($idNum, 0, 2);
			
			if (!ctype_alpha($countryCode))
				return false;
			
			$lastSixChars = substr($idNum, 2);
			
			if (strlen($lastSixChars) == 6 && $this->isInRange($lastSixChars, 0, 999999)
					&& $this->containsAllDigits($lastSixChars))
				return true;
			else
				return false;
		}
		
		
		// checks to see if the class entered is one of Motorsport Irelands karting classes
		public function isValidClass($driverClass) {
			$MI_ClassNames = array("junior max", "kz2", "iame mini", "iame cadet",
			"senior max", "biland", "open class 125", "iame x 30 junior", "iame x 30 senior",
					"x30 senior", "x30 junior");
			
			$driverClass = strtolower($driverClass);
			
			for ($i = 0; $i < sizeof($MI_ClassNames); $i++) {
				if ($driverClass == $MI_ClassNames[$i])
					return true;
			}
			
			
			return false;
		}
		
		
		// checks for a valid position: A position within the range of 1 to 100 (inclusive)
		// or containing dnf, dns, DNS or DNS
		public function isValidPosition($pos) {
			if ($pos == "dnf" || $pos == "DNF" || $pos == "DNS" || $pos == "dns")
				return true;
			else if ($this->containsAllDigits($pos) == false) 
				return false;
			else {
				return $this->isInRange($pos, 1, 100);
			} 
		}
		
		
		
		// Checks to see if a string contains all digits
		public function containsAllDigits($string) {
			$str = str_split($string);
			$strLength = sizeof($str);
			
			if ($strLength == 0)
				return false;
			
			
			for ($i = 0; $i < $strLength; $i++) {
				$char = $str[$i];
				
				if (is_numeric($char) == false)
					return false;
			}
				
			return true;
		}
		
		
		// checks to see if a number is within a given range (where start and finish are included)
		public function isInRange($number, $start, $finish) {
			return ($number >= $start && $number <= $finish) ? true : false;
		}
		
		
		
		// returns an error msg based on the type of error that has occured, denoted by a number
		public function errorMessage($driverResult, $errorNum) {
			$msg = "";
			
			if ($errorNum == 1)
				$msg = "Error - invalid license number entered";
			else if ($errorNum == 2)
				$msg = "Error - invalid driver class entered";
			else if ($errorNum == 3)
				$msg = "Error - invalid position entered";
			
			return $msg . "<br><br>Driver License: " . $driverResult->getDriverID().
							"<br>Driver Name: " . $driverResult->getDriverName() .
							"<br>Driver Class: " . $driverResult->getDriverClassID() .
							"<br>Driver Position: " . $driverResult->getPosition() .
							"<br>CSV File with Error: "; 
		}
		
		
		public function getRaceResultList() {
			return $this->raceResults;
			
		}
		
		
		public function getRaceResultsObj() {
			return $this->raceResults;
		}
		
		
		public function getCSVRows() {
			return $this->csvRows;
		}
		
		
		 const POSITION = 0;
		 const DRIVER_NAME = 2;
		 const DRIVER_CLASS = 3;
		 const DRIVER_ID = 10;
	}


?>