<?php
session_start();
//connect to database
include 'dbconn.php';
//convert race no and track id to int
$_POST['race_number'] = (int)($_POST['race_number']);
$x =($_POST['race_number']);
$_POST['track_id']= (int)($_POST['track_id']);


if(empty($_POST['preDate'])){
    header("Location: ../siteAdmin/updateEventForm2.php?error=Please fill out all fields&race_number=" . $x);
    exit();
}
if(empty($_POST['finalDate'])){
    header("Location: ../siteAdmin/updateEventForm2.php?error=Please fill out all fields&race_number=" . $x);
    exit();
}
if(empty($_POST['h1Date'])){
    header("Location: ../siteAdmin/updateEventForm2.php?error=Please fill out all fields&race_number=" . $x);
    exit();
}
if(empty($_POST['h2Date'])){
    header("Location: ../siteAdmin/updateEventForm2.php?error=Please fill out all fields&race_number=" . $x);
    exit();
}


//final
else{
    $sql1 = "UPDATE race set track_no ='$_POST[track_id]' where race_number = '$_POST[race_number]'";
    $sql2 = "UPDATE race set date ='$_POST[preDate]' where race_number = '$_POST[race_number]' and race_type= 1";
    $sql3 = "UPDATE race set date ='$_POST[finalDate]' where race_number = '$_POST[race_number]' and race_type= 2";
    $sql4 = "UPDATE race set date ='$_POST[h1Date]' where race_number = '$_POST[race_number]' and race_type= -1";
    $sql5 = "UPDATE race set date ='$_POST[h2Date]' where race_number = '$_POST[race_number]' and race_type= 0";


    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $result4 = mysqli_query($conn, $sql4);
    $result5 = mysqli_query($conn, $sql5);


    if ($result1 && $result2 && $result3 && $result4 && $result5) {
         header("Location: ../siteAdmin/updateEventForm2.php?message=Race successfully updated");
            exit();
    } else {
         header("Location: ../siteAdmin/updateEventForm2.php?error=An unknown error occurred");
            exit();
    }
}
mysqli_close($conn);
?>