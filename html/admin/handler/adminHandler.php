<?php
include_once("../../Connections/connection.php");
session_start();
$loggedInId = $_SESSION['admin']['id'];

function getAdmins($id, $conn){
    $sql = "SELECT * FROM `admin` ORDER BY `username` WHERE `id` != '$id'";
    return mysqli_query($conn, $sql);
}

$admins = getAdmins($loggedInId, $conn);
while ($admin = mysqli_fetch_array($admins)){
    array_push($array, $admin);
}

if ($_SESSION['loggedIn']){
    echo json_encode($array);
}

