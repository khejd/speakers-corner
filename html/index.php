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
        Telefonnummer: <input type="number" name="phone" required maxlength="8" minlength="8">
        <input type="submit" name="submit" value="Lagre">
    </form>
</div>

<div class="comment">
    <form action="commentHandler.php" method="post">
          Kommentar: <input type="text" name="comment" required>
                     <input type="submit" name="submit" value="Lagre">
    </form>
</div>



</body>
</html>
