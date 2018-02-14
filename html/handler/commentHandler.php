<?php
include_once("../../Connections/connection.php");

    $comment = $_GET['comment'];
    $phone = $_GET['phone'];

    $sql = "SELECT * FROM `user` WHERE phone_number = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $user_id = $row['id'];

    $sql = "INSERT INTO `comment` (`user_id`, `text`) VALUES ('$user_id', '$comment')";
    $result = mysqli_query($conn, $sql);

    header('Location: ../comments.php');
    exit;

?>
