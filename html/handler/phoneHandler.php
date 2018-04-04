<?php
include_once("../Connections/connection.php");
include_once("../Connections/sms.php");

    $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
    $stmt->bind_param("ii", $phone, $code);

    $phone = intval($_POST['phone']);
    $code = rand(1000, 9999);

    $stmt->execute();
    $stmt->close();

    //Send SMS with code

    echo $code; // replace with $result = $smsGateway->sendMessageToNumber($phone, $code, $deviceID);


?>
