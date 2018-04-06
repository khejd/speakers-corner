<?php
include_once("../../Connections/connection.php");

session_start();

function recordExists($username, $conn){
    $sql = "SELECT * FROM `admin` WHERE `username` = $username";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) == 1;
}

$username = $_POST['username'];

if (recordExists($username, $conn)){
    echo json_encode(array(
        'error' => false
    ));
} else {
    echo json_encode(array(
        'error' => true,
    ));
}
