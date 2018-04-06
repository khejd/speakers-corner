<?php
include_once("../Connections/connection.php");

    function getComments($conn){
        $sql = "SELECT * FROM `comment`";
        return mysqli_query($conn, $sql);
    }

    $comments = getComments($conn);
    $array = array();

    while ($comment = mysqli_fetch_array($comments)){
        array_push($array, $comment);
    }

    echo json_encode($array);

?>
