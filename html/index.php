<?php include_once("../Connections/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <title>Speakers-corner test site</title>

</head>
<body>

<div class="phone">
    <form action="userHandler.php" method="post">
        Telefonnummer: <input type="number" name="phone" required>
                       <input type="submit" name="submit" value="Lagre">
    </form>
</div>

<?php
    $phone = $_GET['phone'];
    $sql = "SELECT * FROM user WHERE phone_number = $phone ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($phone){
        echo "<p>Din kode er:" . $row['code'] . ".";
    }

?>

</br>
<div class="comment">
    <form action="commentHandler.php" method="post">
        Kommentar: <input type="text" name="comment" required>
                   <input type="submit" name="submit" value="Lagre">
    </form>
</div>

<a href="comments.php"><button>Gå til kommentarer</button></a>

</body>


</html>
