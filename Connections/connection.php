<?php
$servername = "localhost";
$username = "root";
$password = "password";
$database = "speakers_corner";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
} else {
    echo "Successful database connection";
}

?>
