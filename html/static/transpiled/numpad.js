'use strict';

var element = '';

// Click on numbers
$('#numpad li').on('click', function (e) {
    if ($('#layer1').hasClass('visible')) {
        element = 'phone';
    } else {
        element = 'code';
    }

    // Check which number is clicked
    for (var i = 0; i < 10; i++) {
        if (parseInt(e.target.id) === i) {
            typeNumber(element, i);
            break;
        }
    }
});

// Click on delete, remove last number
$('#delete').on('click', function () {
    var number_string = $('#' + element);
    if (number_string.length > 0) {
        number_string.val(number_string.val().slice(0, -1));
    }
});

// Click on clear, remove all numbers
$('#clear').on('click', function () {
    $('#' + element).val('');
});

/**
 * @param{string} element
 * @param{int} number
 */
function typeNumber(element, number) {
    $('#' + element).val($('#' + element).val() + number);
}