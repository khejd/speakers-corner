<?php
include_once("../../Connections/connection.php");

function usernameExists($username, $conn){
    $sql = "SELECT * FROM `admin` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function phoneExists($phone, $conn){
    $sql = "SELECT * FROM `admin` WHERE `phone` = '$phone'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

$username = $_POST['username'];
$phone = $_POST['phone'];

if (!usernameExists($username, $conn) && !phoneExists($phone, $conn)){
    echo json_encode(array(
        'error' => false
    ));
} else {
    echo json_encode(array(
        'error' => true
    ));
}
