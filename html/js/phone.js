$(document).ready(() => {
    $('#commentText').text(localStorage.getItem("commentText"));
    changeLanguage(localStorage.getItem("language"));
});

$('#phoneSubmit').on('click',() => {
    $.ajax({
        url: 'handler/phoneHandler.php',
        type: 'POST',
        data: {
            phone: $('#phone').val()
        },
        success: (result) => {
            $('#layer1').removeClass('visible');
            $('#layer2').addClass('visible');

            console.log(result) //code, remove when not developing
        }
    });
});

$('#codeSubmit').on('click', () => {
    $.ajax({
        url: 'handler/codeHandler.php',
        type: 'POST',
        data: {
            code: $('#code').val(),
            comment: localStorage.getItem("commentText"),
            phone: $('#phone').val()
        },
        success: (result) => {
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
