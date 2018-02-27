<?php include_once("../Connections/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                    <textarea class="form-control" maxlength="256" id="transcript" name="comment" placeholder="Hold inne ctrl for å si din mening"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" maxlength="8" minlength="8" name="phone" placeholder="Telefonnummer" required autofocus>
                    <small class="form-text text-muted">
                        Vi kommer ikke til å dele telefonnummeret ditt med andre enn Adressavisa.
                    </small>
                </div>
                <a href="comments.php" role="button" class="btn btn-secondary">Kommentarer</a>
                <button type="submit" name="submit" class="btn btn-primary">Neste</button>
            </form>
        </div>
    </div>
</div>

</body>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
