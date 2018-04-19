// Check if logged in
$.ajax({
    url: 'handler/loggedInHandler.php',
    type: 'GET',
    dataType: 'json',
    success: (result) => {
        if (result.error){
            window.location.href = 'login.html'
        } else {
            $('body').css('display', 'block');
        }
    }
});

let ok = false;

// When submit button is clicked
$('#add').on('click', (e) => {
    e.preventDefault();
    let password = $('#password');
    let retypePassword = $('#retype-password');
    let username = $('#username');
    let phone  = $('#phone');
    let errorMsg = $('#errorMsg');

    password.removeClass('is-invalid');
    retypePassword.removeClass('is-invalid');
    username.removeClass('is-invalid');
    phone.removeClass('is-invalid');

    let deferred = checkUsernameAndPhone(username.val(), phone.val());
    deferred.then(() => {
        if(password.val() !== retypePassword.val()){
            password.addClass('is-invalid');
            retypePassword.addClass('is-invalid');
            errorMsg.text('Passordene er ikke like');
        } else if (!ok){
            username.addClass('is-invalid');
            phone.addClass('is-invalid');
            errorMsg.text('Brukernavnet eller telefonnummeret er allerede registrert.');
        } else {
            add(username.val(), phone.val(), password.val());
        }
    });
});

function checkUsernameAndPhone(username, phone){
    let deferred = $.Deferred();
    $.ajax({
        url: 'handler/usernameHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            username: username,
            phone: phone
        },
        success: (result) => {
            ok = !(result.error);
            deferred.resolve();
        }
    });
    return deferred;
}

function add(username, phone, password){
    $.ajax({
        url: 'handler/addAdminHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            username: username,
            phone: phone,
            password: password
        },
        success: (result) => {
            if (result.error){
                $('#errorMsg').text('Ikke prøv å manipuler koden!');
            } else {
                window.location.href = '/admin';
            }
        }
    });
}
