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

            // Delete admin
            $('.delete-admin').on('click', (e) => {
                let id = e.target.id.replace('admin' + '-','');
                deleteAdmin(id);
            });

            // Delete comment
            $('.delete-comment').on('click', (e) => {
                let id = e.target.id.replace('comment' + '-','');
                deleteComment(id);
            });

            // Logout
            $('#logout').on('click', () => {
                $.ajax({
                    url: 'handler/logoutHandler.php',
                    success: () => {
                        window.location.href = 'login.html'
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
        dataType: 'json',
        success: (result) =>{
            admins = result;
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
            "<tr id='admin-row-"+ arg['id'] +"'><td>" + arg['username'] +
            "<td>" + arg['phone'] +
            "<td><i id='admin-"+ arg['id'] + "' class='fa fa-trash delete-admin'></i></td>"
        );
    }
    table += "</table>";
    $('#admins-table').remove();
    $('#admins').append(table);
}

function deleteAdmin(id){
    if (window.confirm('Vil du virkelig slette denne administratoren?'))
        $.ajax({
            url: 'handler/deleteAdminHandler.php',
            type: 'POST',
            data: {
                id: id
            },
            success: () =>{
                $('#admin-row-' + id).remove();
            }
        });
}

function printCommentsTable(){
    let table = "<table class='table' id='comments-table'><thead>" +
        "<th>Telefonnummer<th>Kommentar<th>Upvotes<th>Downvotes<th>Publisert<th><tbody>";
    for (let arg of comments){
        let phone = arg['phone'];
        phone = phone['phone_number'];
        table += (
            "<tr id='comment-row-"+ arg['id'] +"'><td>" + phone +
            "<td>" + arg['text'] +
            "<td>" + arg['ups'] +
            "<td>" + arg['downs'] +
            "<td>" + arg['time'] +
            "<td><i id='comment-"+ arg['id'] + "' class='fa fa-trash delete-comment'></i></td>"
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
        dataType: 'json',
        success: (result) =>{
            comments = result;
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
            $('#comment-row-' + id).remove();
        }
    });
}
