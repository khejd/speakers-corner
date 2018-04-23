'use strict';

var layer0 = $('#layer0');
var layer1 = $('#layer1');
var layer2 = $('#layer2');
var transcript = $('#transcript');
var language = 'no-NO'; // default

// add listener to disable scroll
window.addEventListener('scroll', function () {
    window.scrollTo(0, 0);
});

//disable right click
window.oncontextmenu = function () {
    return false;
};

$('#modalNo').on('click', function () {
    $('#modal').modal('toggle');
});

if (layer0.hasClass('visible')) {
    $(document).on('click', function () {
        layer0.remove();
        layer1.addClass('visible');
    });
    $(document).on('keydown', function () {
        layer0.remove();
        layer1.addClass('visible');
    });
}

$('.flag').on('click', function (e) {
    layer1.remove();
    layer2.addClass('visible');
    language = e.target.id;

    //Changing language and store in local storage
    changeLanguage(language);
    localStorage.setItem("language", language);
});

// Speech recognition variables
var active = false;
var recognition = '';
var start = '';
var delta = 0;

if (window.hasOwnProperty('webkitSpeechRecognition')) {
    recognition = new webkitSpeechRecognition();
}

// Start speech rec on hold down alt
$(document).on('keydown', function (e) {
    if (e.keyCode === 17) {
        // ctrl
        if (!active) {
            active = true;
            startDictation();
        }
    }
});

// Stop speech rec on keyup ctrl and store the text in local storage
$(document).on('keyup', function (e) {
    if (e.keyCode === 17) {
        // ctrl
        start = Date.now();
    }
});

var TIMEOUT = 1000; // 1 sec
window.setInterval(checkKeyUp, TIMEOUT);

function checkKeyUp() {
    delta = Date.now() - start;
    if (active && delta > TIMEOUT) {
        active = false;
        recognition.stop();

        if (layer2.hasClass('visible') && transcript.val() !== "") {
            $('#confirmationModal').modal('show');
            layer2.css('z-index', 'auto');
        }
        $('#commentText span').text(transcript.val());
        localStorage.setItem("commentText", transcript.val());
    }
}

function startDictation() {
    var final_transcript = '';

    recognition.continuous = true;
    recognition.interimResults = true;
    recognition.lang = language; // Set by flag click
    recognition.start();

    recognition.onresult = function (e) {
        var interim_transcript = '';
        for (var i = e.resultIndex; i < e.results.length; ++i) {
            if (e.results[i].isFinal) {
                final_transcript += e.results[i][0].transcript;
            } else {
                interim_transcript += e.results[i][0].transcript;
            }
        }
        // Write to textarea
        transcript.val(final_transcript + interim_transcript);
    };
    recognition.onerror = function () {
        recognition.stop();
    };
}