<?php
include_once("../../Connections/connection.php");

    $code = intval($_POST['code']);
    $phone = intval($_POST['phone']);
    $comment =  $_POST['comment'];

    $sql = "SELECT * FROM `user` WHERE `phone_number` = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($code == $row['code']){
        $stmt = $conn->prepare("INSERT INTO `comment` (`user_id`, `text`) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $comment);

        $user_id = $row['id'];
        $stmt->execute();
        $stmt->close();

    } else {
        echo "error";
    }

    exit;


?>
