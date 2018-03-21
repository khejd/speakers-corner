<?php
include_once("../../Connections/connection.php");

    $code = $_POST['code'];
    $phone = $_POST['phone'];
    $comment =  $_POST['comment'];

    $sql = "SELECT * FROM `user` WHERE `phone_number` = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $stmt = $conn->prepare("INSERT INTO `comment` (`user_id`, `text`) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $comment);

    $user_id = $row['id'];
    $stmt->execute();
    $stmt->close();

    exit;


?>
