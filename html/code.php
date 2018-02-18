<?php
include_once("../Connections/connection.php");
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <script src="../js/bootstrap.min.js"></script>

</head>
<body>

<br>
<div class="container">
    <div class="card">
        <div class="card-header">
            Speakers corner
        </div>
        <div class="card-body text-center">

            <?php
            $phone = $_GET['phone'];
            $comment = $_GET['comment'];
            $sql = "SELECT * FROM `user` WHERE `phone_number` = $phone";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);


                echo "<h4 class='card-title'>Din kode er</h4>
                      <h5>".$row['code']."</h5>
                      <br>";
                echo "<div class='container center_div'>
                        <form class='form-inline' method='post' action='handler/codeHandler.php?phone=$phone&comment=$comment'>
                            <div class='form-group mx-sm-3 mb-2'>
                                <input type='number' class='form-control' name='code' placeholder='Skriv inn kode' required autofocus>
                            </div>
                            <button type='submit' name='submit' class='btn btn-primary mb-2'>Publiser mening</button>
                        </form>";

            ?>
        </div>
    </div>
</div>

</body>
</html>
