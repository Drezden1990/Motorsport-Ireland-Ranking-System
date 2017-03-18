<?php


	class Driver {
		
		private $driverID;
		private $driverName;
		private $driverClass;
		
		private $totalPoints;
	
		private $penaltyPoints;
		private $registered;
		private $driverType;
		
		private $day;
		private $month;
		private $year;
		private $country;
		private $password;
		
		// 10 + 2 (for dob)
		// registered, name, licensenum, dob, class, points, penalty points, type (general or elite), country
		
		
		function __construct($driverID, $firstName, $lastName, $driverClass,
				$day, $month, $year, $country) {
			$this->driverID = $driverID;
			
			$firstName = $this->replaceApostrophes($firstName);
			$lastName = $this->replaceApostrophes($lastName);
			$this->driverName = $firstName . " " . $lastName;
			
			$this->setClassID($driverClass);
			$this->totalPoints = 0;
		
			$this->registered = true;
			$this->penaltyPoints = 0;
			$this->driverType = 1;
			
			$this->day = $day;
			$this->month = $month;
			$this->year = $year;
		
			$this->country = $country;	
			$this->password = $driverID . $lastName;
		}
		
	
		
		public function setClassID($class) {
			$MI_ClassNames = array("junior max", "kz2", "iame mini", "iame cadet",
					"senior max", "biland", "open class 125", "iame x 30 junior", "iame x 30 senior",
					"x30 senior", "x30 junior");
			
			
			$class = strtolower($class);
			$class = trim($class);
			
			for ($i = 0; $i < sizeof($MI_ClassNames); $i++) {
				
				if ($class == $MI_ClassNames[$i] && $i < 7) {
					$this->driverClass= $i + 1;
				} else if ($class == $MI_ClassNames[$i] && ($i == 7 || $i == 10)) // for the variations on x30 junior
						$this->driverClass = 8;
				else  if ($class == $MI_ClassNames[$i] && ($i == 8 || $i == 9)) // for the variations on x30 senior
					$this->driverClass = 9;		
			}
				
			
		}
		
		public function replaceApostrophes($name) {
			$pos = strpos($name, "'");
				
			 if ($pos != false) {
			 	$endOfName = substr($name, $pos, $pos);
				$name = substr_replace($name, "''", $pos, $pos);
			}	
			
			return $name;
		}
		
		
		public function getDriverID() {
			return $this->driverID;
		}
		
		
		public function getDriverClass() {
			return $this->driverClass;
		}
		
		
		public function getDriverName() {
			return $this->driverName;
		}
		

		public function getPoints() {
			return $this->totalPoints;
		}
		
		
		public function getCountry() {
			return $this->country;
		}
		
		
		public function getRegStatus(){
			return $this->registered;
		}
		
		
		public function getDriverDOB() {
			return $this->year."-".$this->month."-".$this->day;
		}
		
		
		public function getPassword() {
			return $this->password;
		}
		
				
		const GENERAL = 1;
		const ELITE = 2;
		
	}
?>