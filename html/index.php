include('../Connections/connection.php');

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
    $sql = "INSERT INTO comment (user_id, comment)
    VALUES ('".$_POST["user_id"]."','".$_POST["comment"]."')";

    $result = mysqli_query($conn,$sql);
}

?>

<div class="input">
    <form action ="index.php" method="post">
        <select name="user"> <!-- Need back-end connection here -->
            <option value="1">User 1</option>
        </select>
        <input type="text" name="comment" x-webkit-speech />
        <button type="submit">Send inn</button>
    </form>
</div>



</body>
</html>
