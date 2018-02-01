<?php
include_once("../Connections/connection.php");

if (isset($_POST['submit'])){

    $phone = $_GET['phone'];
    $code = $_POST['code'];

    $sql = "SELECT * FROM user WHERE phone_number = $phone ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($row['code'] == $code){
        $sql = "INSERT INTO user (verified) VALUES (1)";
        $result = mysqli_query($conn, $sql);
        header('Location: index.php?phone='.$phone.'?user=verified');
    } else {
        header('Location: index.php');
    }

    exit;
}

?>
