<?php

if (isset($_POST['submit'])){
    $comment = $_POST['comment'];
    $user_id = 1;
    $sql = "INSERT INTO comment (user_id, text) VALUES ('$user_id', '$comment')";
    if(!mysqli_query($conn,$sql)){
        echo "Not inserted";
    } else {
        echo "Inserted";
    }
}

?>
