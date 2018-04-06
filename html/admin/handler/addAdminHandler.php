<?php
include_once("../../Connections/connection.php");

function addAdmin($username, $phone, $password, $conn){
    $stmt = $conn->prepare("INSERT INTO `admin` (`username`, `phone`, `password`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $phone, $password);
    $stmt->execute();
    $stmt->close();
}

function usernameExists($username, $conn){
    $sql = "SELECT * FROM `admin` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        throw new Exception('Username exists');
    }
}

function phoneExists($phone, $conn){
    $sql = "SELECT * FROM `admin` WHERE `phone` = '$phone'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        throw new Exception('Phone exists');
    }
}

$username = $_POST['username'];
$phone = $_POST['phone'];
$password = MD5($_POST['password']);

try {
    usernameExists($username, $conn);
    phoneExists($phone, $conn);
    addAdmin($username, $phone, $password, $conn);
    echo json_encode(array(
        'error' => false
    ));
} catch (Exception $e) {
    echo json_encode(array(
        'error' => true
    ));
}
