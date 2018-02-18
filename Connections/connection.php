<?php
$servername = "localhost";
$username = "admin";
$password = "EgD6hLTKQF";
$database = "speakers_corner";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
}
?>
