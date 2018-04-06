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

// On document ready
$(() => {
    let comments = '';
    let admins = '';
    let deferredAdmin = getAdmins();
    let deferredComments = getCommentAndPhone();

    // When all admins are fetched
    deferredAdmin.then(() => {
        printAdminsTable();

        // When all comments are fetched
        deferredComments.then(() => {
            printCommentsTable();

            // Delete comment
            $('.delete').on('click', (e) => {
                let id = e.target.id;
                deleteComment(id);
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
        });


    });
});

function getAdmins(){
    let deferred = $.Deferred();
    $.ajax({
        url: 'handler/adminHandler.php',
        type: 'GET',
        success: (result) =>{
            admins = JSON.parse(result);
            deferred.resolve();
        }
    });
    return deferred;
}

function printAdminsTable(){
    let table = "<table class='table' id='admins-table'><thead>" +
        "<th>Brukernavn<th>Telefonnummer<th><th><tbody>";
    for (let arg of admins){
        table += (
            "<tr><td>" + arg['username'] +
            "<td>" + arg['phone'] +
            "<td><i id='"+ arg['id'] + "' class='fa fa-trash delete'></i></td>"
        );
    }
    table += "</table>";
    $('#admins-table').remove();
    $('#admins').append(table);
}


function printCommentsTable(){
    let table = "<table class='table' id='comments-table'><thead>" +
        "<th>Telefonnummer<th>Kommentar<th>Upvotes<th>Downvotes<th>Publisert<th><tbody>";
    for (let arg of comments){
        let phone = arg['phone'];
        phone = phone['phone_number'];
        table += (
            "<tr><td>" + phone +
            "<td>" + arg['text'] +
            "<td>" + arg['ups'] +
            "<td>" + arg['downs'] +
            "<td>" + arg['time'] +
            "<td><i id='"+ arg['id'] + "' class='fa fa-trash delete'></i></td>"
        );
    }
    table += "</table>";
    $('#comments-table').remove();
    $('#comments').append(table);
}

function getCommentAndPhone(){
    let deferred = $.Deferred();
    $.ajax({
        url: 'handler/commentAndPhoneHandler.php',
        type: 'GET',
        success: (result) =>{
            comments = JSON.parse(result);
            deferred.resolve();
        }
    });
    return deferred;
}

function deleteComment(id){
    if (window.confirm('Vil du virkelig slette denne kommentaren?'))
    $.ajax({
        url: 'handler/deleteCommentHandler.php',
        type: 'POST',
        data: {
            id: id
        },
        success: () =>{
            let deferred = getCommentAndPhone();
            deferred.then(() =>{
                printCommentsTable();
            });

        }
    });
}
