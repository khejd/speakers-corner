$.ajax({
    url: 'handler/loggedInHandler.php',
    type: 'GET',
    success: (result) => {
        let res = $.parseJSON(result);
        if (!res.error){
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
                window.location.href = '/admin'
            }
        }
    });
});
