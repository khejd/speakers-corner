let layer0 = $('#layer0');
let layer1 = $('#layer1');
let layer2 = $('#layer2');
let transcript = $('#transcript');
let language = 'no-NO'; // default

// add listener to disable scroll
window.addEventListener('scroll', () =>{
    window.scrollTo(0,0);
});

//disable right click
window.oncontextmenu = () => false;

$('#modalNo').on('click', () => {
    $('#modal').modal('toggle');
});

layer0.on('click', () => {
    layer0.remove();
    layer1.addClass('visible');
});

$('.flag').on('click', (e) => {
    layer1.remove();
    layer2.addClass('visible');
    language = e.target.id;

    //Changing language and store in local storage
    changeLanguage(language);
    localStorage.setItem("language", language);
});

// Speech recognition variables
let active = false;
let recognition = '';
let start = '';
let delta = 0;

if (window.hasOwnProperty('webkitSpeechRecognition')) {
    recognition = new webkitSpeechRecognition();
}

// Start speech rec on hold down ctrl
$(document).on('keydown', (e) => {
    if (e.keyCode === 17) { //ctrl
        if (!active) {
            active = true;
            startDictation();
        }
    }
});

// Stop speech rec on keyup ctrl and store the text in local storage
$(document).on('keyup', (e) => {
    if (e.keyCode === 17){ // ctrl
        start = Date.now();
    }
});

const TIMEOUT = 1000; // 1 sec
window.setInterval(() => {
    checkKeyUp();
}, TIMEOUT);

function checkKeyUp(){
    delta = Date.now() - start;
    if (active && delta > TIMEOUT){
        active = false;
        recognition.stop();

        if (layer2.hasClass('visible') &&  transcript.val()!==""){
            $('#confirmationModal').modal('show');
            layer2.css('z-index', 'auto');
        }
        $('#commentText span').text(transcript.val());
        localStorage.setItem("commentText", transcript.val());
    }
}

function startDictation() {
    let final_transcript = '';

    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.lang = language;
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
        // Write to textarea
        transcript.val(final_transcript + interim_transcript);
    };
    recognition.onerror = () => {
        recognition.stop();
    };
}
