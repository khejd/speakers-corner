<?php
include_once("../Connections/connection.php");

function updateLocation($lat, $lng, $accuracy, $conn){
        $sql = "UPDATE `coordinates` SET `latitude` = '$lat', `longitude` = '$lng', `accuracy` = '$accuracy' WHERE `coordinates`.`id` = 1";
        mysqli_query($conn, $sql);
}

$lat = $_POST['latitude'];
$lng = $_POST['longitude'];
$accuracy = $_POST['accuracy'];

updateLocation($lat, $lng, $accuracy, $conn);
