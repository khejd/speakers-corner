<?php
include_once("../../Connections/connection.php");

if (isset($_POST['submit'])){

    $code = $_POST['code'];
    $phone = $_GET['phone'];
    $comment =  $_GET['comment'];

    $sql = "SELECT * FROM user WHERE phone_number = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($row['code'] != $code){
        header('Location: ../comment.php');
    } else {
        header('Location: commentHandler.php?phone='.$phone.'&comment='.$comment);
    }

    exit;
}

?>
