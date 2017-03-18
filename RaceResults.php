<?php

	//include_once 'DriverResult.php';
	
	class RaceResults {
		private $results = array();
		private $raceFileLocation;
		private $raceType;
			
		function __construct($fileLocation, $fileType) {
			$this->raceType = $fileType;
			$this->raceFileLocation = $fileLocation;
			
		}
		
		// adds a driver result to the Race Results array of results
		public function addDriverResult($driverResult) {
			 $this->results[] = $driverResult;
		}
		
		
		// returns the race results array
		public function getRaceResults() {
			return $this->results;
		}
		
		
		// returns a driver result at a specified index
		public function getDriverResult($index) {
			return $this->results[$index];
		}
		
		
		// gets the length of the race results array
		public function resultsLen() {
			return sizeof($this->results);
		}
		
		
		public function getRaceType() {
			return $this->raceType;
		}
		
		
		// returns the locaction fo the race file
		public function getFileLocation() {
			return $this->raceFileLocation;
		}
		
		
	}

?>