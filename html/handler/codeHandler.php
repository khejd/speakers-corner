<?php
include_once("../Connections/connection.php");

    function insertRecord($code, $user, $comment, $conn){

        if ($code != $user['code']){
            throw new Exception('Wrong code');
        }

        $user_id = $user['id'];
        $stmt = $conn->prepare("INSERT INTO `comment` (`user_id`, `text`) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $comment);

        $stmt->execute();
        $stmt->close();
    }

    function getUser($phone, $conn){
        $sql = "SELECT * FROM `user` WHERE `phone_number` = $phone";
        $result = mysqli_query($conn, $sql);
        return mysqli_fetch_array($result);
    }

    $code = $_POST['code'];
    $phone = $_POST['phone'];
    $comment =  $_POST['comment'];
    $user = getUser($phone, $conn);

    try {
        insertRecord($code, $user, $comment, $conn);
        echo json_encode(array(
            'error' => false
        ));
    } catch (Exception $e){
        echo json_encode(array(
            'error' => true,
            'msg' => $e->getMessage()
        ));
    }

?>
