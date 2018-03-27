
let element = '';

$('#numpad li').click(function (e) {
    if ($('#layer1').hasClass('visible')){
        element = 'phone';
    } else {
        element = 'code';
    }

    for (let i = 0; i< 10; i++){
        if (e.target.id === i){
            typeNumber(element, i);
            break;
        }
    }
});

$('#delete').click(function () {
    let number_string = $('#' + element);
    if (number_string.length>0) {
        number_string.val(number_string.val().slice(0, -1));
    }
});

$('#clear').click(function () {
    $('#' + element).val('');
});

/**
 * @param{string} element
 * @param{int} number
 */
function typeNumber(element, number) {
    $('#' + element).val($('#' + element).val()+number);
}
