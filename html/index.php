<?php include_once("../Connections/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../css/app.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <script src="../../js/bootstrap.min.js"></script>
    <title>Speakers-corner test site</title>

</head>
<body>

<br>

<div class="container">
    <div class="card">
        <div class="card-header">
            Speakers corner
        </div>
        <div class="card-body">
            <h5 class="card-title">Hva brenner du for?</h5>
            <img onclick="startDictation()" src="../img/mic.gif" class="speech"/>
            <form action="phoneHandler.php" method="post">
                <div class="form-group">
                    <textarea class="form-control" id="transcript" name="comment" placeholder="Si din mening"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Telefonnummer" required>
                    <small class="form-text text-muted">
                        Vi kommer ikke til å dele telefonnummeret ditt med andre enn Adressavisen.
                    </small>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Neste</button>
            </form>
        </div>
    </div>
</div>

<a href="comments.php"><button>Gå til kommentarer</button></a>

</body>

<!-- HTML5 Speech Recognition API -->
<script>
    function startDictation() {

        if (window.hasOwnProperty('webkitSpeechRecognition')) {

            var recognition = new webkitSpeechRecognition();

            recognition.continuous = false;
            recognition.interimResults = false;

            recognition.lang = "no-NO";
            recognition.start();

            recognition.onresult = function(e) {
                document.getElementById('transcript').value
                    = e.results[0][0].transcript;
                recognition.stop();
            };

            recognition.onerror = function(e) {
                recognition.stop();
            }
        }
    }
</script>


</html>
