// When submit button is clicked
$('#login').on('click', () => {
    console.log($('#username').val());
    $.ajax({
        url: 'handler/loginHandler.php',
        type: 'POST',
        data: {
            username: $('#username').val(),
            password: $('#password').val()
        },
        success: (result) => {
            let res = $.parseJSON(result);
            if (res.error){
                $('#code').addClass('is-invalid');
                $('#errorMsg').text(res.msg);
            } else {
                window.location.href = 'loggedin.html'
            }
        }
    });
});
