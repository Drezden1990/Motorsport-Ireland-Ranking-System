<?php
include 'dbconn.php';

$sql = "DELETE FROM driver where Licence_No = '$_POST[licence_no]';";
$sql2 = "DELETE FROM user where user_id = '$_POST[licence_no]';";


$result1 = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

if ($result1 && $result2) {
    header("Location: ../siteAdmin/deleteDriver.php?message=success");
        exit();
} else {
 header("Location: ../siteAdmin/deleteDriver.php?error=error");
        exit();}

mysqli_close($conn);
?>