<?php include_once("../Connections/connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <title>Speakers-corner test site</title>



</head>
<body>


<?php

if(isset($_POST['save']))
{
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

<div class="input">
    <form action="index.php" method="post">
          Kommentar: <input type="text" name="comment">
                     <input type="submit" value="Lagre">
    </form>
</div>



</body>
</html>
