let layer1 = $('#layer1');
let layer2 = $('#layer2');
let transcript = $('#transcript');
let backToStart = $('#start');

backToStart.on('click', () => {
    window.location.reload();
});

$('.flag').on('click', () => {
    layer1.removeClass('visible');
    layer2.addClass('visible');
});


// Speech recognition
let active = false;
let recognition = '';

if (window.hasOwnProperty('webkitSpeechRecognition')) {
    recognition = new webkitSpeechRecognition();
}

$(document).on('keydown', (e) => {
    if (e.keyCode === 17){ //ctrl
        if (!active){
            active = true;
            startDictation();
        }
    }
});

$(document).on('keyup', (e) => {
    if (e.keyCode === 17){ // stop when keyup ctrl
        active = false;
        recognition.stop();
        if (layer2.hasClass('visible')){
            $('#confirmationModal').modal('show');
            layer2.css('z-index', 'auto');
        }
        $('#commentText span').text(transcript.val());
        localStorage.setItem("commentText", transcript.val());
    }
});

function startDictation() {

    let final_transcript = '';

    recognition.continuous = true;
    recognition.interimResults = true;

    recognition.lang = "no-NO";
    recognition.start();

    recognition.onresult = (e) => {
        let interim_transcript = '';
        for (let i = e.resultIndex; i < e.results.length; ++i) {
            if (e.results[i].isFinal) {
                final_transcript += e.results[i][0].transcript;
            } else {
                interim_transcript += e.results[i][0].transcript;
            }
        }

        transcript.val(final_transcript + interim_transcript);
    };

    recognition.onerror = () => {
        recognition.stop();
    };
}
