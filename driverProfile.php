<?php
	include_once 'CSVReader.php';
	include_once 'Driver.php';
	
	$system = new DriverInfoToDB();		// create a MI_System
	$system->main();				// run the MI_System

	 class DriverInfoToDB {
	 	private $drivers = array();
		
		public function main() {/*
			$fileLocation = "\/var\/www\/example.com\/public_html\/Round 14 M.I. Championship 2016 DB.csv";
			$reader = new CSVReader($fileLocation, 1);
			echo "<br>Csv read: ", $reader->readFromCSV($fileLocation);
			
			$driverInfo = $reader->getCSVRows();			// get array of race results
		
			$this->createDriverList($driverInfo);
			$this->addDriverListToDB();*/
            echo "Hello";
			
		}
		
		
		public function displayResults($driversInfo) {
			
			for ($i = 0; $i < sizeof($driversInfo); $i++) {
				
				echo "Class: ", $driversInfo[$i][0], "&nbsp&nbspName: ", $driversInfo[$i][2];
				echo "&nbsp&nbsp", $driversInfo[$i][1], "&nbsp";
				echo "DOB: ", $driversInfo[$i][3], "-",  $driversInfo[$i][4], "-", $driversInfo[$i][5];
				echo "&nbsp&nbspREG = yes", "&nbsp&nbspCountry: ", $driversInfo[$i][7], "&nbsp";
				echo "&nbspID = ", $driversInfo[$i][9], "<br>";
				
			}
			
		}
		
		
		public function printArray($array) {
			echo '<pre>';
			print_r($array);
			echo '</pre>';
		
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
		
		public function addDriverListToDB() {
			$servername = "localhost";
			
			$username = "root";			// Login credentials
			$password = "q6ib8j2x";		
	
			$dbname = "temp";
			
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			// Check connection
			if (!$conn) {
				die("Connection fairiofdjled: " . mysqli_connect_error());
			} else 
				echo "<br>Connection succeeded<br><br>";
				
			$this->addAndDisplayDrivers($conn);
	
		//	 $this->removeDriversAndDisplay($conn);
			

		}
		
		public function addAndDisplayDrivers($conn) {
			
			$this->addDriversToDB($conn);
			echo"<br><br> Drivers added to table:<br> <br>";
			$sql = "SELECT * FROM driver_tmp;";
			$this->displayTable($conn, $sql);
			
		}
		
		public function removeDriversAndDisplay($conn) {
			$this->remove_N_Drivers(sizeof($this->drivers), $conn);
				
			echo "<br><br>Remove those drivers deletion: <br>";
			$sql = "SELECT * FROM driver_tmp;";
			$this->displayTable($conn, $sql);
			
		}
		
		public function addDriversToDB($conn) {
			
			for ($i = 0; $i <  sizeof($this->drivers) - 1;$i++) {
				$name = $this->drivers[$i]->getDriverName();
				$id = $this->drivers[$i]->getDriverID();
				$dob = $this->drivers[$i]->getDriverDOB();
				$classID = $this->drivers[$i]->getDriverClass();
				$country = $this->drivers[$i]->getCountry();
				$password = $this->drivers[$i]->getPassword();
			
				$sql  = "INSERT INTO driver_tmp(Name, Licence_No, DOB, Class_ID, Penalty_Points,
					Championship_Points, Country, Registered, Driver_Type, Password)
					 VALUES ('". $name. "', '". $id . "', '". $dob. "', ". $classID. ", ". 0 . ", ". 0 . ", ' "
								 		. $country . "', " .  1 . ", ". 1 . " );";
			
				if (mysqli_query($conn, $sql)) {
					//	echo "New record created successfully.<br>";
				} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn). "<br><br>";
				}
								 									 		 
			}
		}
		
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
		
		public function remove_N_Drivers($num, $conn) {
			for ($i = 0; $i < $num; $i++) {
				$id = $this->drivers[$i]->getDriverID();
				
				$this->deleteResult($conn, $id);
			}
			
		}
		
		public function deleteResult($conn, $id){
			// sql to delete a record
			$sql = "DELETE FROM driver_tmp WHERE Licence_No= '".$id."'";
			
			if ($conn->query($sql) === TRUE) {
				echo "Record deleted successfully", "<br>";
			} else {
				echo "Error deleting record: " . $conn->error, "<br>";
			}
				
		}
		
		
		
		/*
		 $sql = "INSERT INTO driver_tmp(name, licence_No, DOB, class, penalty_points,
		 championship_points, country, Registered, Driver_Type)
		 VALUES ('Simon Lowry', 'EI147222', '1990-10-10', 1, 0, 0, 'IRELAND', 1, 1 );
		 "; */
		
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