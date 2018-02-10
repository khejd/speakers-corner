<?php include_once("../Connections/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <script src="../js/bootstrap.min.js"></script>
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
            <form action="handler/phoneHandler.php" method="post">
                <div class="form-group">
                    <textarea class="form-control" id="transcript" name="comment" placeholder="Hold inne ctrl for å si din mening"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Telefonnummer" required>
                    <small class="form-text text-muted">
                        Vi kommer ikke til å dele telefonnummeret ditt med andre enn Adressavisen.
                    </small>
                </div>
                <a href="comments.php" role="button" class="btn btn-secondary">Kommentarer</a>
                <button type="submit" name="submit" class="btn btn-primary">Neste</button>
            </form>
        </div>
    </div>
</div>


</body>

<!-- HTML5 Speech Recognition API -->
<script>
    var active = false;

    if (window.hasOwnProperty('webkitSpeechRecognition')) {
        var recognition = new webkitSpeechRecognition();
    }

    document.onkeydown = function(e){
        if (e.keyCode == 17){ //ctrl
            if (!active){
                active = true;
                startDictation();
            }
        }
    };

    document.onkeyup = function(event){
        if (event.keyCode == 17){ // stop when keyup ctrl
            active = false;
            recognition.stop();
        }
    };

    function startDictation() {

        var final_transcript = '';

        recognition.continuous = true;
        recognition.interimResults = true;

        recognition.lang = "no-NO";
        recognition.start();

        recognition.onresult = function(e) {
            var interim_transcript = '';
            for (var i = e.resultIndex; i < e.results.length; ++i) {
                if (e.results[i].isFinal) {
                    final_transcript += e.results[i][0].transcript;
                } else {
                    interim_transcript += e.results[i][0].transcript;
                }
            }

            document.getElementById('transcript').value = final_transcript + interim_transcript;

        };

        recognition.onerror = function(e) {
            recognition.stop();
        };
    }
</script>


</html>
