<?php
session_start();
//connect to database
include 'dbconn.php';


//create temp password
$pass = $_POST['id'] . $_POST['lname'];
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['id'];


if(empty($id)){
    header("Location: ../siteAdmin/newAdminForm.php?error=Please fill in all fields");
    exit();
}

if(empty($fname)){
    header("Location: ../siteAdmin/newAdminForm.php?error=Please fill in all fields");
    exit();
}

if(empty($lname)){
    header("Location: ../siteAdmin/newAdminForm.php?error=Please fill in all fields");
    exit();
}

if(strlen($_POST['id']) !== 8){
    header ("Location: ../siteAdmin/newAdminForm.php?error=Invalid ID length");
    exit();
}

$first2 = substr($_POST['id'], 0, 2);
$last6 = substr($_POST['id'], 2);

if(!ctype_alpha($first2)){
    header ("Location: ../siteAdmin/newAdminForm.php?error=Invalid ID");
    exit();
}
if(!ctype_digit($last6)){
    header ("Location: ../siteAdmin/newAdminForm.php?error=Invalid ID");
    exit();
}


else{
    $sql = "select user_id from user where user_id = '$_POST[id]'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        header("Location: ../siteAdmin/newAdminForm.php?error=ID number already in use");
        exit();
    }

    else{
        $sql = "INSERT INTO site_admin (fname, lname, id)
        VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[id]')";

        $sql2 = "INSERT INTO user (user_id, pw, user_type) VALUES ('$_POST[id]', '$pass', 1)";

        $result1 = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        if ($result1 && $result2) {
            header ("Location: ../siteAdmin/newAdminForm.php?message=New admin successfully added");
        } else {
        header ("Location: ../siteAdmin/newAdminForm.php?error=An unknown error occurred");       
        }
    }
}
mysqli_close($conn);
?>