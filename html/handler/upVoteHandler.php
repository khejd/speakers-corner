<?php
include_once("../../Connections/connection.php");

    $id = $_POST['id'];

    $cookie_name = "vote";
    $comment_id = array(
        "comments" => array(
            "id" => $id,
            "vote" => 1
        )
    );
    $cookie_value = $comment_id;

    setcookie($cookie_name, json_encode($cookie_value), time() + 86400, "/"); // 86400 = expires in one day

    if($_COOKIE[$cookie_value.$comment_id->comments->vote] == 0){
        $sql = "UPDATE `comment` SET `vote` = `vote` + 1 WHERE `comment`.`id` = $id";
        $result = mysqli_query($conn, $sql);
    }

    if($_COOKIE[$cookie_value.$comment_id->comments->vote] == 1){
        $sql = "UPDATE `comment` SET `vote` = `vote` - 1 WHERE `comment`.`id` = $id";
        $result = mysqli_query($conn, $sql);
    }


?>
