let comments = '';
let ids = [];
let language = 'no-NO'; // default

// On document ready
$(() => {
    let deferred = getComments();

    // When all comments are fetched
    deferred.then(() => {
        sortBy('trending');
        changeLanguage(localStorage.getItem("language"));

        // If cookies are not accepted yet, show popup
        if (typeof Cookies.get('accept_cookies') === 'undefined'){
            let popup = $('#cookie_popup');
            popup.addClass('show');
            $('.cookies_button').on('click',() => {
                popup.removeClass('show');
                Cookies.set('accept_cookies', 1, { expires: 7 });
            });
        }

        // Sort comments
        $('.sort-selector').on('click', (e) => {
            let sorter = e.target.id;
            sortBy(sorter);
        });

        // Click on flag
        $('.flag').on('click', (e) => {
            language = e.target.id;
            //Changing language and store in local storage
            changeLanguage(language);
            localStorage.setItem("language", language);
        });

        // Click on comment
        $('#comments').on('click', 'i', (e) => {
            let action = e.target.id.split('-')[0];
            let id = e.target.id.replace(action + '-','');
            let votes =  $('#vote-' + id);
            vote(action, id);

            // Increment/decrement vote when click on vote-arrow
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
        url: '../handler/commentHandler.php',
        type: 'GET',
        dataType: 'json',
        success: (result) =>{
            comments = result;
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
            url: "../handler/voteHandler.php",
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
