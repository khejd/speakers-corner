<?php
include_once("../Connections/connection.php");

if (isset($_POST['submit'])){

    $x = 4; // Amount of digits
    $min = pow(10,$x);
    $max = pow(10,$x+1)-1;
    $code = rand($min, $max);

    $phone = $_POST['phone'];
    $comment = $_POST['comment'];
    $sql = "INSERT INTO user (phone_number, code) VALUES ('$phone', '$code')";
    mysqli_query($conn, $sql);

    header('Location: code.php?phone='.$phone.'&comment='.$comment);

    exit;
}

?>
