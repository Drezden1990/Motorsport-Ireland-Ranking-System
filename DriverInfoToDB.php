<?php
	include_once 'CSVReader.php';
	include_once 'Driver.php';
	
	$system = new DriverInfoToDB();		// create a MI_System
	$system->main();				// run the MI_System

	 class DriverInfoToDB {
	 	private $drivers = array();
		
		public function main() {
			$fileLocation = "/var/www/example.com/public_html/Round14M.I.Championship2016DB.csv";
			$reader = new CSVReader($fileLocation, 1);
			echo "<br>Csv read: ", $reader->readFromCSV($fileLocation);
			
			$driverInfo = $reader->getCSVRows();			// get array of race results
		
			$this->createDriverList($driverInfo);
			$this->addDriverListToDB();
			
			
		}
		
		
		
		
		public function createDriverList($driversInfo) {
			
			for ($i = 0; $i < sizeof($driversInfo); $i++) {
				
				$first = $driversInfo[$i][2];
				$last = $driversInfo[$i][1];
				$class = $driversInfo[$i][0];
				
				$day = $driversInfo[$i][3];
				$month = $driversInfo[$i][4];
				$year = $driversInfo[$i][5];
				
				
				$country = $driversInfo[$i][7];
				$id = $driversInfo[$i][9];
			
				
				$this->drivers[] = new Driver($id, $first, $last, $class,
						$day, $month, $year, $country); 
			}
			
		}
		
		// creates the connection to the db, and then adds and displays drivers added to the db
		public function addDriverListToDB() {
			$servername = "localhost";
			
			$username = "root";			// Login credentials
			$password = "q6ib8j2x";		
	
			$dbname = "tmp";
			
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			// Check connection
			if (!$conn) {
				die("Connection fairiofdjled: " . mysqli_connect_error());
			} else 
				echo "<br>Connection succeeded<br><br>";
				
			$this->addAndDisplayDrivers($conn);
			

		}
		
		public function addAndDisplayDrivers($conn) {
			
			$this->addDriversToDB($conn);
			echo"<br><br> Drivers added to table:<br> <br>";
			$sql = "SELECT * FROM driver_tmp;";
			$this->displayTable($conn, $sql);
			
		}
		
		
		
		// inserts a set of drivers into the driver database table
		public function addDriversToDB($conn) {
			
			for ($i = 0; $i <  sizeof($this->drivers) - 1;$i++) {
				$name = $this->drivers[$i]->getDriverName();
				$id = $this->drivers[$i]->getDriverID();
				$dob = $this->drivers[$i]->getDriverDOB();
				$classID = $this->drivers[$i]->getDriverClass();
				$country = $this->drivers[$i]->getCountry();
				$password = $this->drivers[$i]->getPassword();
			
				$sql  = "INSERT INTO driver(Name, Licence_No, DOB, Class_ID, Penalty_Points,
					Championship_Points, Country, Registered, Driver_Type)
					 VALUES ('". $name. "', '". $id . "', '". $dob. "', ". $classID. ", ". 0 . ", ". 0 . ", ' "
								 		. $country . "', " .  1 . ", ". 1 . " );";
			    $sql2 = "INSERT INTO user (user_id, pw, user_type) VALUES ('". $id . "', '". $password . "', " . 3 . ");";
				
				if (!mysqli_query($conn, $sql) && mysqli_query($conn, $sql2))  
						echo "Error: " . $sql . "<br>" . mysqli_error($conn). "<br><br>";
				
								 									 		 
			}
		}
		
		
		// displays a tables entries
		public function displayTable($conn, $sql) {
			
			if ($result=mysqli_query($conn,$sql))
			{
				while ($obj=mysqli_fetch_object($result))
				{
					printf("<br>%s    %s,    %s,    %s         %s",$obj->Name, $obj->Licence_No, $obj->DOB,  $obj->Country
							, $obj->Password, "<br>");
				}
				// Free result set
				mysqli_free_result($result);
			}else {
				echo "<br>Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			echo "<br><br>";
			
		}
		
		
		
	
		const CLASS_ = 0;
		const L_NAME = 1;
		const F_NAME = 2;
		const DAY = 3;
		const MONTH = 4;
		const YEAR = 5;
		const REG = 6;
		const COUNTRY = 7;
		const ID = 9;
		
		

     }
?>