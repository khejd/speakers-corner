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
        Telefonnummer: <input type="number" name="phone" required min="10000000" max="99999999">
                       <input type="submit" name="submit" value="Lagre">
    </form>
</div>

<?php
    $phone = $_GET['phone'];
    $verified = $_GET['user'];
    $sql = "SELECT * FROM user WHERE phone_number = $phone ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($phone && !$verified){
        echo "<div>Din kode er: ". $row['code'] . "</div>";
        echo "Skriv inn koden for å verifisere at det er deg: ";
        echo "<form action='codeHandler.php?phone=$phone' method='post'>
                <input type='number' name='code' max='9999'>
                <input type='submit' name='submit' value='Send inn'>
              </form>";
    }

    if ($verified){
        echo "<div class='comment'>
                <form action='commentHandler.php?phone=$phone' method='post'>
                    Kommentar: <input type='text' name='comment' required>
                    <input type='submit' name='submit' value='Lagre'>
                </form>
              </div>";
        }
?>

<a href="comments.php"><button>Gå til kommentarer</button></a>

</body>


</html>
