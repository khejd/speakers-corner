<?php
include_once("../Connections/connection.php");

function getLocation($conn){
    $sql = "SELECT * FROM `coordinates`";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_array($result);
}

echo json_encode(getLocation($conn));
