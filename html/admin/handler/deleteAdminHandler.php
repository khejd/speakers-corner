<?php
include_once("../../Connections/connection.php");
session_start();

$id = $_POST['id'];

if($_SESSION['loggedIn']){
    $sql = "DELETE FROM `admin` WHERE `id` = $id";
    return mysqli_query($conn, $sql);
}

