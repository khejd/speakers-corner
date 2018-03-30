
let comments = '';
let ids = [];

$(function () {
    let deferred = getComments();

    deferred.then(() => {
        sortBy('trending');

        if (typeof Cookies.get('accept_cookie') === 'undefined'){
            let popup = $('#cookie_popup');
            popup.addClass('show');
            $('.cookies_span').on('click',() => {
                popup.removeClass('show');
                Cookies.set('accept_cookies', 1);
            });
        }

        $('.sort_selecter').on('click', (e) => {
            let sorter = e.target.id;
            sortBy(sorter);
        });

        $('#comments').on('click', 'i', (e) => {
            let action = e.target.id.split('-')[0];
            let id = e.target.id.replace(action + '-','');
            let votes =  $('#vote-' + id);
            vote(action, id);
            if (action === 'up' && !$(e.target).hasClass('disabled') && !ids.includes(id)){
                votes.text(parseInt(votes.text()) + 1);
                $(e.target).addClass('fa-lg disabled');
                ids.push(id);
            } else if(action === 'down' && !$(e.target).hasClass('disabled') && !ids.includes(id)){
                votes.text(parseInt(votes.text()) - 1);
                $(e.target).addClass('fa-lg disabled');
                ids.push(id);
            }
        });
    });

});

function getComments(){
    let deferred = $.Deferred();
    $.ajax({
        url: 'handler/commentHandler.php',
        type: 'GET',
        success: (result) =>{
            comments = JSON.parse(result);
            deferred.resolve();
        }
    });
    return deferred;
}

/**
 * @param{string} action
 * @param{string} id
 */
function vote(action, id){
    if (navigator.cookieEnabled && typeof Cookies.get('accept_cookies') !== 'undefined'){
        $.ajax({
            url: "handler/voteHandler.php",
            type: 'POST',
            data: {
                action: action,
                id: id
            }
        });
    } else {
        alert('Please enable cookies to vote.');
    }
}
