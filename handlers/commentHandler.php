<?php
include_once("../Connections/connection.php");

if (isset($_POST['submit'])){
    $comment = $_POST['comment'];
    $phone = $_GET['phone'];

    $sql = "SELECT * FROM user WHERE phone_number = $phone ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $user_id = $row['id'];

    $sql = "INSERT INTO comment (user_id, text) VALUES ('$user_id', '$comment')";
    if(!mysqli_query($conn,$sql)){
        echo "Not inserted";
    } else {
        echo "Inserted";
    }

    header('Location: comments.php');
    exit;
}

?>
