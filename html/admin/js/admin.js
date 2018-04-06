// Check if logged in
$.ajax({
    url: 'handler/loggedInHandler.php',
    type: 'GET',
    success: (result) => {
        let res = $.parseJSON(result);
        if (res.error){
            window.location.href = 'index.html'
        } else {
        $('body').css('display', 'block');
        }
    }
});

// Logout
$('#logout').on('click', () => {
    $.ajax({
        url: 'handler/logoutHandler.php',
        success: () => {
            window.location.href = 'index.html'
        }
    });
});

