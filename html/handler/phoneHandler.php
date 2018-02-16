<?php
include_once("../../Connections/connection.php");

if (isset($_POST['submit'])){

    $x = 4; // Amount of digits
    $min = pow(10,$x);
    $max = pow(10,$x+1)-1;
    $code = rand($min, $max);


    $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
    $stmt->bind_param("ii", $phone, $comment);

    $phone = $_POST['phone'];
    $comment = $_POST['comment'];
    $stmt->execute();
    $stmt->close();

    header('Location: ../code.php?phone='.$phone.'&comment='.$comment);

    exit;
}

?>
