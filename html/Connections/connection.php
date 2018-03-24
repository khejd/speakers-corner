<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
}
?>
