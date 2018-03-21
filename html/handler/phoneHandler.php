<?php
include_once("../../Connections/connection.php");

    $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
    $stmt->bind_param("ii", $phone, $code);

    $code = rand(1000, 9999);
    $phone = $_POST['phone'];

    $stmt->execute();
    $stmt->close();

    exit;


    //Send SMS with code


?>
