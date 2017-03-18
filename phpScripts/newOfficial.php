<?php
session_start();
//connect to database
include 'dbconn.php';


//create temp password
$pass = $_POST['id'] . $_POST['lname'];

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];


if(empty($id)){
    header("Location: ../siteAdmin/newOfficialForm.php?error=empty");
    exit();
}

if(empty($fname)){
    header("Location: ../siteAdmin/newOfficialForm.php?error=empty");
    exit();
}

if(empty($lname)){
    header("Location: ../siteAdmin/newOfficialForm.php?error=empty");
    exit();
}
else{
    $sql = "select user_id from user where user_id = '$_POST[id]'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        header("Location: ../siteAdmin/newOfficialForm.php?error=user");
        exit();
    }

    else{

        $sql = "INSERT INTO official (fname, lname, id)
        VALUES ('$_POST[fname]', '$_POST[lname]', '$_POST[id]')";

        $sql2 = "INSERT INTO user (user_id, pw, user_type) VALUES ('$_POST[id]', '$pass', 2)";

        $result1 = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        if ($result1 && $result2) {
            $last_id = mysqli_insert_id($conn);
                header("Location: ../siteAdmin/newOfficialForm.php?message=success");
        } else {
                header("Location: ../siteAdmin/newOfficialForm.php?error=error");
        }
    }
}
mysqli_close($conn);
?>