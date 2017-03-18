<?php
	
	include_once 'Driver.php';
	
	class DriverResult {
		private $driverID;
		private $driverName;
		private $driverClassID;
		private $totalPoints;
		
		private $position;
		
		
		function __construct($driverID, $position, $name, $driverClass) {
			$this->driverID = $driverID;
			$this->position = $position;
			$this->driverName = $name;
			$this->driverClassID = $driverClass;
		}
		
		
		public function setTotalPoints($points) {
			$this->totalPoints = $points;
		}
		
		
		public function getDriverID() {
			return $this->driverID;
		}
		
		
		public function convertClassNametoID() {
			$MI_ClassNames = array("junior max", "kz2", "iame mini", "iame cadet",
					"senior max", "biland", "open class 125", "iame x 30 junior", "iame x 30 senior",
					"x30 senior", "x30 junior");
				
				
			$this->driverClassID = strtolower($this->driverClassID);
			$this->driverClassID = trim($this->driverClassID);
				
			for ($i = 0; $i < sizeof($MI_ClassNames); $i++) {
		
				if ($this->driverClassID == $MI_ClassNames[$i] && $i < 7) {
					$this->driverClassID= $i + 1;
				} else if ($this->driverClassID == $MI_ClassNames[$i] && ($i == 7 || $i == 10)) // for the variations on x30 junior
					$this->driverClassID = 8;
				else  if ($this->driverClassID == $MI_ClassNames[$i] && ($i == 8 || $i == 9)) // for the variations on x30 senior
					$this->driverClassID = 9;
				
					
			}
			if ($this->driverClassID == null)
				echo "Name: ", $this->driverName, "< Class: ", $class, "<br>";
				
		}
		
		public function getDriverClassID() {
			return $this->driverClassID;
		}
		
		
		public function getClassName() {
			$MI_ClassNames = array("junior max", "kz2", "iame mini", "iame cadet",
					"senior max", "biland", "open class 125", "iame x 30 junior", "iame x 30 senior");
			
			return $MI_ClassNames[$this->driverClassID - 1];
	
		}
		
		
		public function getDriverName() {
			return $this->driverName;
		}
		
		
		
		
		public function getPosition() {
			return $this->position;
		}
		
		
		public function getPoints() {
			return $this->totalPoints;
		}
		
		
		public function incPoints($points) {
			$this->totalPoints += $points;
		}
		
		
		public function toString() {
			return ("Name: " .$this->driverName 
					."   Position: ".$this->position 
					."   Class: " . $this->driverClass);
		}
		
		
	}
	

?>