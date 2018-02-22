<?php
include_once("../../Connections/connection.php");

    $id = $_POST['id'];
    $cookie_name = "vote";
    $new_entry = array(
        'id' => $id,
        'vote' => 'up'
    );

    if(!isset($_COOKIE[$cookie_name])){
        $cookie_value = array();
        array_push($cookie_value, $new_entry);
    } else {
        $cookie_value = json_decode($_COOKIE[$cookie_name], true);
        $key = array_search($id, array_column($cookie_value, 'id'));

        if ($cookie_value[$key]['id'] == $id){
            if ($cookie_value[$key]['vote'] == 'down'){
                $cookie_value[$key]['vote'] = 'none';
            } else if ($cookie_value[$key]['vote'] == 'none'){
                $cookie_value[$key]['vote'] = 'up';
            }
        } else {
            array_push($cookie_value, $new_entry);
        }

    }

    setcookie($cookie_name, json_encode($cookie_value), time() + 86400, "/"); // 86400 = expires in one day

    $data = json_decode($_COOKIE[$cookie_name], true);
    $key = array_search($id, array_column($data, 'id'));

    if(isset($_COOKIE[$cookie_name])){
        if($data[$key]['vote'] == 'none'){ // one reload behind
            $sql = "UPDATE `comment` SET `vote` = `vote` + 1 WHERE `comment`.`id` = $id";
            $result = mysqli_query($conn, $sql);
        }

        if($data[$key]['vote'] == 'down'){
            $sql = "UPDATE `comment` SET `vote` = `vote` + 1 WHERE `comment`.`id` = $id";
            $result = mysqli_query($conn, $sql);
            $cookie_value[$key]['vote'] = 'none';
            setcookie($cookie_name, json_encode($cookie_value), time() + 86400, "/");
        }
    } else {
        $sql = "UPDATE `comment` SET `vote` = `vote` + 1 WHERE `comment`.`id` = $id";
        $result = mysqli_query($conn, $sql);
    }


?>
