<?php
include_once("../Connections/connection.php");

function updateLocation($lat, $lng, $conn){
        $sql = "UPDATE `coordinates` SET `latitude` = '$lat', `longitude` = '$lng' WHERE `coordinates`.`id` = 1";
        mysqli_query($conn, $sql);
}

$lat = $_POST['latitude'];
$lng = $_POST['longitude'];

updateLocation($lat, $lng, $conn);
