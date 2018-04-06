// Check if logged in
$.ajax({
    url: 'handler/loggedInHandler.php',
    type: 'GET',
    success: (result) => {
        let res = $.parseJSON(result);
        if (res.error){
            window.location.href = 'login.html'
        } else {
            $('body').css('display', 'block');
        }
    }
});

// When submit button is clicked
$('#add').on('click', (e) => {
    e.preventDefault();
    if($('#password').val() !== $('#retype-password').val()){
        $('#password').addClass('is-invalid');
        $('#retype-password').addClass('is-invalid');
        $('#errorMsg').text('Passordene er ikke like');
    } else if (!checkUsername($('#username').val())){
        $('#password').addClass('is-invalid');
        $('#errorMsg').text('Brukernavnet er allerede registrert');
    } else {
        add($('#username').val(), $('#phone').val(), $('#password').val());
    }

});

function checkUsername(username){
    $.ajax({
        url: 'handler/usernameHandler.php',
        type: 'POST',
        data: {
            username: username
        },
        success: (result) => {
            let res = $.parseJSON(result);
            return res.error
        }
    });
}

function add(username, phone, password){
    $.ajax({
        url: 'handler/addAdminHandler.php',
        type: 'POST',
        data: {
            username: username,
            phone: phone,
            password: password
        },
        success: (result) => {
            let res = $.parseJSON(result);
            if (res.error){
                $('#errorMsg').text('Ikke prøv å manipuler koden!');
            } else {
                window.location.href = 'index.html';
            }
        }
    });
}
