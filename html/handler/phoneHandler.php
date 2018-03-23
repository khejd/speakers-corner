<?php
include_once("../../Connections/connection.php");

    $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
    $stmt->bind_param("ii", $phone, $code);

    $phone = intval($_POST['phone']);
    $code = rand(1000, 9999);

    $stmt->execute();
    $stmt->close();


    //Send SMS with code
    echo $code; // remove when not developing


?>
