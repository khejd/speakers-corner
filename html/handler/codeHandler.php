<?php
include_once("../Connections/connection.php");

    function insert($code, $phone, $comment, $conn){
        $sql = "SELECT * FROM `user` WHERE `phone_number` = $phone";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);

        if ($code != $row['code']){
            throw new Exception('Wrong code');
        }

        $user_id = $row['id'];
        $stmt = $conn->prepare("INSERT INTO `comment` (`user_id`, `text`) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $comment);

        $stmt->execute();
        $stmt->close();
    }

    $code = intval($_POST['code']);
    $phone = intval($_POST['phone']);
    $comment =  $_POST['comment'];

    try {
        insert($code, $phone, $comment, $conn);
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
