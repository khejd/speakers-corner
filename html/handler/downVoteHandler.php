<?php
include_once("../../Connections/connection.php");

    $id = $_POST['id'];
    $cookie_name = "vote";
    $new_entry = array(
        'id' => $id,
        'vote' => 0
    );

    if(!isset($_COOKIE[$cookie_name])){
        $cookie_value = array();
        array_push($cookie_value, $new_entry);

    } else {
        $cookie_value = json_decode($_COOKIE[$cookie_name], true);
        $key = array_search($id, array_column($cookie_value, 'id'));
        if ($cookie_value[$key]['id'] == $id){
            $cookie_value[$key]['vote'] = 0;
        } else {
            array_push($cookie_value, $new_entry);
        }

    }

    setcookie($cookie_name, json_encode($cookie_value), time() + 86400, "/"); // 86400 = expires in one day

    $data = json_decode($_COOKIE[$cookie_name], true);
    $key = array_search($id, array_column($data, 'id'));

    if($data[$key]['vote'] == 1){
        $sql = "UPDATE `comment` SET `vote` = `vote` - 1 WHERE `comment`.`id` = $id";
        $result = mysqli_query($conn, $sql);
    }

    if($data[$key]['vote'] == 0){
        $sql = "UPDATE `comment` SET `vote` = `vote` + 1 WHERE `comment`.`id` = $id";
        $result = mysqli_query($conn, $sql);
    }
?>
