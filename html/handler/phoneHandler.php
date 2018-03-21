<?php
include_once("../../Connections/connection.php");

    $data = json_decode($_POST['data']);

    $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
    $stmt->bind_param("ii", $phone, $code);

    $code = rand(1000, 9999);
    $phone = $data['phone'];

    $stmt->execute();
    $stmt->close();

    //Send SMS with code

    echo $data;

?>
