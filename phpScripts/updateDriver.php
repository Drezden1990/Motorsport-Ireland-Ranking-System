<?php
session_start();
//connect to database
include '../phpScripts/dbconn.php';
// Convert class and type values to integers to update database
$_POST['class']= (int)($_POST['class']);
$_POST['Championship_Points']= (int)($_POST['Championship_Points']);
$_POST['standard']= (int)($_POST['standard']);
$_POST['penalty_points']= (int)($_POST['penalty_points']);

$name=$_POST['Name'];

$country = $_POST['country'];
$PPoints = $_POST['penalty_points'];

$query = "SELECT * FROM user WHERE user_id = '$id'";
$result = mysqli_query($conn, $query);

if(empty($name)){
    header("Location: ../siteAdmin/editDriverFormpt2.php?error=Please fill in all fields&licence_no=" .$_POST['Licence_No']);
    exit();
}

if(!isset($_POST['dob'])){
    header("Location: ../siteAdmin/editDriverFormpt2.php?error=Please fill in all fields&licence_no=" .$_POST['Licence_No']);   
    exit();
}

else if(empty($country)){
    header("Location: ../siteAdmin/editDriverFormpt2.php?error=Please fill in all fields&licence_no=" .$_POST['Licence_No']); 
    exit();
}


else{


    //final

    $sql1 = "UPDATE driver set Name ='$_POST[Name]' where Licence_No = '$_POST[Licence_No]'";
    $sql2= "UPDATE driver set DOB ='$_POST[dob]' where Licence_No = '$_POST[Licence_No]'";
    $sql3 = "UPDATE driver set Class_ID ='$_POST[class]' where Licence_No = '$_POST[Licence_No]'";
    $sql4 = "UPDATE driver set Registered ='$_POST[registered]' where Licence_No = '$_POST[Licence_No]'";
    $sql5 = "UPDATE driver set Driver_Type ='$_POST[standard]' where Licence_No = '$_POST[Licence_No]'";
    $sql6 = "UPDATE driver set Country ='$_POST[country]' where Licence_No = '$_POST[Licence_No]'";
    $sql7 = "UPDATE driver set Penalty_Points ='$_POST[penalty_points]' where Licence_No = '$_POST[Licence_No]'";


    $result1 = mysqli_query($conn, $sql1);
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $result4 = mysqli_query($conn, $sql4);
    $result5 = mysqli_query($conn, $sql5);
    $result6 = mysqli_query($conn, $sql6);
    $result7 = mysqli_query($conn, $sql7);

$h = $_POST['registered'];
    if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6 && $result7) {
        header("Location: ../siteAdmin/editDriverFormpt1.php?message=Driver information successfully updated"); 
        exit();
    } else {
        header("Location: ../siteAdmin/editDriverFormpt1.php?error=An unknown error occurred"); 
        exit();
    }
}
mysqli_close($conn);
?>