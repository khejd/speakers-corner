<?php
include_once("../../Connections/connection.php");

if (isset($_POST['submit'])){

    $stmt = $conn->prepare("INSERT INTO `user` (`phone_number`, `code`) VALUES (?, ?)");
    $stmt->bind_param("ii", $phone, $code);

    $code = rand(1000, 9999);
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    $stmt->execute();
    $stmt->close();

    header('Location: ../code.php?phone='.$phone.'&comment='.$comment);

    exit;
}

?>
