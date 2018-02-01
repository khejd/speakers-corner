<?php
include_once("../Connections/connection.php");

if (isset($_POST['submit'])){

    $x = 4; // Amount of digits
    $min = pow(10,$x);
    $max = pow(10,$x+1)-1;
    $code = rand($min, $max);

    $phone = $_POST['phone'];
    $sql = "INSERT INTO user (phone_number, code) VALUES ('$phone', '$code')";
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM user WHERE phone_number = $phone";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $verified = $row['verified'];

    header('Location: index.php?phone='.$phone.'&user='.$verified);

    exit;
}

?>
