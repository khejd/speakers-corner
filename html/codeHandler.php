<?php
include_once("../Connections/connection.php");

if (isset($_POST['submit'])){

    $phone = $_GET['phone'];
    $code = $_POST['code'];

    $sql = "SELECT * FROM user WHERE phone_number = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $id = $row['id'];

    if ($row['code'] == $code){
        $sql = "UPDATE user SET verified = 1 WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        header('Location: index.php?phone='.$phone.'&user=1');
    } else {
        header('Location: index.php');
    }

    exit;
}

?>
