<?php
    include_once("../Connections/connection.php");

    function updateVote($action, $conn){
        if ($action == 'up') {
            $sql = "UPDATE `comment` SET `ups` = `ups` + 1 WHERE `comment`.`id` = $id";
            mysqli_query($conn, $sql);
        } else if ($action == 'down') {
            $sql = "UPDATE `comment` SET `downs` = `downs` + 1 WHERE `comment`.`id` = $id";
            mysqli_query($conn, $sql);
        }
    }

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
        updateVote($action, $conn);

    } else {
        $cookie_value = json_decode($_COOKIE[$cookie_name], true);

        if (!in_array($id, array_column($cookie_value, 'id'))){
            array_push($cookie_value, $new_entry);
            updateVote($action, $conn);
        }

    }

    setcookie($cookie_name, json_encode($cookie_value), time() + 86400, "/"); // 86400 = expires in one day

?>
