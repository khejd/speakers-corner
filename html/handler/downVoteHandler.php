<?php
include_once("../../Connections/connection.php");

    if(isset($_COOKIE[$cookie_name])) {
        if ($_COOKIE[$cookie_value]){
            $id = $_POST['id'];
            $sql = "UPDATE `comment` SET `vote` = `vote` - 1 WHERE `comment`.`id` = $id";
            $result = mysqli_query($conn, $sql);
        } else {
            $cookie_value = 1;
        }

    }

?>
