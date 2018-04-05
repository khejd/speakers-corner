<?php
include_once("../Connections/connection.php");
include_once("../Connections/sms.php");

    function recordExists($phone, $conn){
        $sql = "SELECT * FROM `user` WHERE `phone_number` = $phone";
        $result = mysqli_query($conn, $sql);
        return mysqli_num_rows($result) > 0;
    }

    function updateCode($phone, $code, $conn){
        $sql = "UPDATE `user` SET `code` = $code WHERE `phone_number` = $phone";
        mysqli_query($conn, $sql);
    }

    function insertRecord($phone, $code, $conn){
        $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
        $stmt->bind_param("si", $phone, $code);
        $stmt->execute();
        $stmt->close();
    }

    $phone = $_POST['phone'];
    $code = rand(1000, 9999);

    if(recordExists($phone, $conn)){
        updateCode($phone, $code, $conn);
    } else {
        insertRecord($phone, $code, $conn);
    }

    //Send SMS with code

    echo $code; // replace with $result = $smsGateway->sendMessageToNumber($phone, $code, $deviceID);


?>
