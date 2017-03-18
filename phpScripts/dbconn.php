<?php
$servername = "localhost";
$username = "root";
$password = "q6ib8j2x";
$dbname = "tmp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>