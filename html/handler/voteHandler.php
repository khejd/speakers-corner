<?php
    include_once("../../Connections/connection.php");

    $action = $_POST['action'];
    $id = $_POST['id'];
    $cookie_name = "vote";
    $new_entry = array(
        'id' => $id,
        'vote' => $action
    );

    if(!isset($_COOKIE[$cookie_name])){
        $cookie_value = array();
        array_push($cookie_value, $new_entry);
    } else {
        $cookie_value = json_decode($_COOKIE[$cookie_name], true);
        $key = array_search($id, array_column($cookie_value, 'id'));

        if ($cookie_value[$key]['id'] != $id){
            array_push($cookie_value, $new_entry);
        }

    }

    setcookie($cookie_name, json_encode($cookie_value), time() + 86400, "/"); // 86400 = expires in one day

    $data = json_decode($_COOKIE[$cookie_name], true);
    $key = array_search($id, array_column($data, 'id'));

    echo json_encode($cookie_value);

    /*if ($cookie_value[$key]['id'] != $id){
        if($data[$key]['vote'] == 'up'){
            $sql = "UPDATE `comment` SET `ups` = `ups` + 1 WHERE `comment`.`id` = $id";
            $result = mysqli_query($conn, $sql);
            echo 1;
        } else if($data[$key]['vote'] == 'down'){
            $sql = "UPDATE `comment` SET `downs` = `downs` - 1 WHERE `comment`.`id` = $id";
            $result = mysqli_query($conn, $sql);
            echo -1;
        }
    }*/

?>
