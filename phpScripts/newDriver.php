<?php
session_start();
//connect to database
include 'dbconn.php';

// Convert class and type values to integers to update database
$_POST['class']= (int)($_POST['class']);
$_POST['standard']= (int)($_POST['standard']);
//$_POST['penalty_points']= (int)($_POST['penalty_points']);
$pass = $_POST['driver_id'] . $_POST['lname'];
$name = $_POST['fname'] . " " . $_POST['lname'];

$empty = "Please fill in all details";

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$id = $_POST['driver_id'];
$CPoints = $_POST['Championship_Points'];
$country = $_POST['country'];
$PPoints = $_POST['penalty_points'];

$query = "SELECT * FROM user WHERE user_id = '$id'";
$result = mysqli_query($conn, $query);

if(empty($fname)){
    header("Location: ../siteAdmin/driverForm.php?error=$empty");
    exit();
}

if(empty($lname)){
    header("Location: ../siteAdmin/driverForm.php?error=$empty");
    exit();
}

if(!isset($_POST['dob'])){
    header("Location: ../siteAdmin/driverForm.php?error=$empty");
    exit();
}

if(empty($country)){
    header("Location: ../siteAdmin/driverForm.php?error=$empty");
    exit();
}
if(strlen($_POST['driver_id']) !== 8){
    header ("Location: ../siteAdmin/driverForm.php?error=Invalid ID length&$y");
    exit();
}

$first2 = substr($_POST['driver_id'], 0, 2);
$last6 = substr($_POST['driver_id'], 2);

if(!ctype_alpha($first2)){
    header ("Location: ../siteAdmin/driverForm.php?error=Invalid ID");
    exit();
}
if(!ctype_digit($last6)){
    header ("Location: ../siteAdmin/driverForm.php?error=Invalid ID");
    exit();
}


else if($row = mysqli_fetch_assoc($result)){
    header("Location: ../siteAdmin/driverForm.php?error=ID number already in use");
    exit();
}


else{
    $sql = "INSERT INTO driver(Name, Licence_No, DOB, Class_ID,Registered, Driver_Type, country, Penalty_Points, Championship_Points)
    VALUES ('$name', '$_POST[driver_id]', '$_POST[dob]', '$_POST[class]', '$_POST[registered]', '$_POST[standard]', '$_POST[country]', '$_POST[penalty_points]')";

    $sql2 = "INSERT INTO user (user_id, pw, user_type) VALUES ('$_POST[driver_id]', '$pass', 3)";

    $result1 = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);

    if ($result1 && $result2) {
        header("Location: ../siteAdmin/driverForm.php?message=Driver added successfully");
        exit();   
    } else {
        header("Location: ../siteAdmin/driverForm.php?error=An unknown error occurred");
        exit(); 
    }
}
mysqli_close($conn);
?>