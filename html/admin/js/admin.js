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

// On document ready
$(() => {
    // Fetch comments
    let comments = '';
    let deferred = getCommentAndPhone();

    deferred.then(() =>{
        printTable(comments);
    });
});

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

function printTable(comments){
    let table = "<table class='table' id='comments-table'><thead>" +
        "<th>Telefonnummer<th>Kommentar<th>Upvotes<th>Downvotes<th>Publisert<th><tbody>";
    for (let arg of comments){
        table += (
            "<tr><td>" + arg['phone'] +
            "<td>" + arg['text'] +
            "<td>" + arg['ups'] +
            "<td>" + arg['downs'] +
            "<td>" + arg['time'] +
            "<td><i id='"+ arg['id'] + "' class='fas fa-trash'></i></td>"
            );
    }
    table += "</table>";
    $('#comments-table').remove();
    $('#comments').append(table);
}
