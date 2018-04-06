<?php
include_once("../../Connections/connection.php");

function getComments($conn){
    $sql = "SELECT * FROM `comment` ORDER BY TIME";
    return mysqli_query($conn, $sql);
}

function getPhone($comment, $conn){
    $id = $comment['user_id'];
    $sql = "SELECT * FROM `user` WHERE `id` = '$id'";
    return mysqli_query($conn, $sql);
}

$comments = getComments($conn);
$array = array();

while ($comment = mysqli_fetch_array($comments)){
    $comment['phone'] = getPhone($comment, $conn);
    array_push($array, $comment);
}

echo json_encode($array);

