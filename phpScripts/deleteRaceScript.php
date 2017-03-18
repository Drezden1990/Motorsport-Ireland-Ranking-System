<?php
include 'dbconn.php';
$sql = "DELETE FROM race where race_number = '$_POST[race_number]'";
$sql2 = "DELETE FROM results where race_num = '$_POST[race_number]'";

if(mysqli_query($conn, $sql)  && mysqli_query($conn, $sql2)){
    header ("Location: ../siteAdmin/deleteRace.php?message=Race successfully deleted");
    exit();
}
else{
    header ("Location: ../siteAdmin/deleteRace.php?message=An unknown error occurred");
    exit();
}
?>