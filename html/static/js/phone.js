// On document ready
$(() => {
    $('#commentText').text(localStorage.getItem("commentText"));
    changeLanguage(localStorage.getItem("language"));
});

// When phone submit button is clicked
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

// When code submit button is clicked
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
                window.location.replace('comments/');
            }
        }
    });
});
