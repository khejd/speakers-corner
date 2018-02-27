<?php
include_once("../Connections/connection.php");
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


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
                                <input type='text' maxlength='4' minlength='4' class='form-control' name='code' placeholder='Skriv inn kode' required autofocus>
                            </div>
                            <button type='submit' name='submit' class='btn btn-primary mb-2'>Publiser mening</button>
                        </form>";

            ?>
        </div>
    </div>
</div>

</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
