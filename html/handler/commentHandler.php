<?php
include_once("../Connections/connection.php");

    $sql = "SELECT * FROM `comment` ORDER BY `time` LIMIT 20";
    $result = mysqli_query($conn, $sql);

    $array = array();

    while ($row = mysqli_fetch_array($result)){
        array_push($array, $row);
    }

    echo json_encode($array);

?>
