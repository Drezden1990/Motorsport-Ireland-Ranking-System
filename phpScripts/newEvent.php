<?php
session_start();
//connect to database
include 'dbconn.php';
//convert race no and track id to int
$_POST['race_number'] = (int)($_POST['race_number']);
$_POST['track_id']= (int)($_POST['track_id']);

$empty = "Please fill in all fields";

$num = $_POST['race_number'];
$track = $_POST['track_id'];
$h1 = $_POST['h1Date'];
$h2 = $_POST['h2Date'];
$pre = $_POST['preDate'];
$final = $_POST['finalDate'];

$query = "SELECT * FROM race WHERE race_number = '$_POST[race_number]'";
$result = mysqli_query($conn, $query);

if(empty($num)){
    header("Location: ../siteAdmin/addEventForm.php?error=$empty");
    exit();
}
if(empty($track)){
    header("Location: ../siteAdmin/addEventForm.php?error=$empty");
    exit();
}

if(empty($h1)){
    header("Location: ../siteAdmin/addEventForm.php?error=$empty");
    exit();
}

if(empty($h2)){
    header("Location: ../siteAdmin/addEventForm.php?error=$empty");
    exit();
}

if(empty($pre)){
    header("Location: ../siteAdmin/addEventForm.php?error=empty");
    exit();
}

if(empty($final)){
    header("Location: ../siteAdmin/addEventForm.php?error=$empty");
    exit();
}


else if($row = mysqli_fetch_assoc($result)){
    header("Location: ../siteAdmin/addEventForm.php?error=Race number is already in use");
    exit();
}
else{

    $sql1 = "INSERT INTO race (race_number, race_type, track_no, date) VALUES ('$_POST[race_number]', 2,'$_POST[track_id]', '$_POST[finalDate]')";
    $sql2 = "INSERT INTO race (race_number, race_type, track_no, date) VALUES ('$_POST[race_number]', 1,'$_POST[track_id]', '$_POST[preDate]')";
    $sql3 = "INSERT INTO race (race_number, race_type, track_no, date) VALUES ('$_POST[race_number]', -1,'$_POST[track_id]', '$_POST[h1Date]')";
    $sql4 = "INSERT INTO race (race_number, race_type, track_no, date) VALUES ('$_POST[race_number]', 0,'$_POST[track_id]', '$_POST[h2Date]')";

    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $result4 = mysqli_query($conn, $sql4);


    if ($result1 && $result2 && $result3 && $result4) {
        $last_id = mysqli_insert_id($conn);
        header("Location: ../siteAdmin/addEventForm.php?message=Race event successfully added");
        exit();
    } else {
        header("Location: ../siteAdmin/addEventForm.php?error=An unknown error occurred");
        exit();
    }
}
mysqli_close($conn);
?>