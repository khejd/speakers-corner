<?php
include_once("../../Connections/connection.php");

session_start();

function getAdmin($username, $conn){
    $sql = "SELECT * FROM `admin` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
}

function login($username, $password, $conn){
    $admin = getAdmin($username, $conn);
    if (!$admin){
        throw new Exception('User does not exist');
    }
    if ($admin['password'] != $password){
        throw new Exception('Wrong password');
    }
}

$username = $_POST['username'];
$password = MD5($_POST['password']);

try {
    login($username, $password, $conn);
    $_SESSION['loggedIn'] = true;
    $_SESSION['admin'] = getAdmin($username, $conn);
    echo json_encode(array(
        'error' => false
    ));
} catch (Exception $e){
    echo json_encode(array(
        'error' => true,
        'msg' => $e->getMessage(),
    ));
}



