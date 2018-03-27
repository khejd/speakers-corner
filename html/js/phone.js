$(document).ready(function () {
    $('#commentText').text(localStorage.getItem("commentText"));
});

$('#phoneInput button').click(function () {
    $.ajax({
        url: 'handler/phoneHandler.php',
        type: 'POST',
        data: {
            phone: $('#phone').val()
        },
        success: function (result) {
            $('#layer1').removeClass('visible');
            $('#layer2').addClass('visible');

            console.log(result) //code, remove when not developing
        }
    });
});

$('#codeInput button').click(function () {
    $.ajax({
        url: 'handler/codeHandler.php',
        type: 'POST',
        data: {
            code: $('#code').val(),
            comment: localStorage.getItem("commentText"),
            phone: $('#phone').val()
        },
        success: function (result) {
            let res = $.parseJSON(result);
            if (res.error){
                $('#code').addClass('is-invalid');
                $('#errorMsg').text(res.msg);
            } else {
                window.location.href = 'comments.html'
            }
        }
    });
});
