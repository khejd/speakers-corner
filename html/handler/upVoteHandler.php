<?php
include_once("../../Connections/connection.php");

    $id = $_POST['id'];
    $sql = "UPDATE `comment` SET `vote` = `vote` + 1 WHERE `comment`.`id` = $id";
    $result = mysqli_query($conn, $sql);

?>
