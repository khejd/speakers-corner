<?php
include_once("../../Connections/connection.php");


    $phone = $_GET['phone'];

    $sql = "SELECT * FROM `user` WHERE phone_number = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $stmt = $conn->prepare("INSERT INTO `comment` (`user_id`, `text`) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $comment);

    $user_id = $row['id'];
    $comment = $_GET['comment'];
    $stmt->execute();
    $stmt->close();

    header('Location: ../comments.php');
    exit;

?>
