<?php
include 'dbconn.php';

$sql = "DELETE FROM official where id = '$_POST[id]';";
$sql2 = "DELETE FROM user where user_id = '$_POST[id]';";


$result1 = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

if ($result1 && $result2) {
    header ("Location: ../siteAdmin/deleteOfficial.php?message=Official removed successfully");
    exit();
} 
else {
    header ("Location: ../siteAdmin/deleteOfficial.php?error=An unknown error occurred");
    exit();
}

mysqli_close($conn);
?>