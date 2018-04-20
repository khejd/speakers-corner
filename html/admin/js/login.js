$.ajax({
    url: 'handler/loggedInHandler.php',
    type: 'GET',
    dataType: 'json',
    success: (result) => {
        if (!result.error){
            window.location.href = '/admin'
        }
    }
});

// When submit button is clicked
$('#login').on('click', (e) => {
    e.preventDefault();
    $.ajax({
        url: 'handler/loginHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            username: $('#username').val(),
            password: $('#password').val()
        },
        success: (result) => {
            if (result.error){
                $('#code').addClass('is-invalid');
                $('#errorMsg').text(result.msg);
            } else {
                window.location.href = '/admin'
            }
        }
    });
});
