'use strict';

var comments = '';
var ids = [];

// On document ready
$(function () {
    var deferred = getComments();

    // When all comments are fetched
    deferred.then(function () {
        sortBy('trending');
        changeLanguage(localStorage.getItem("language"));

        // If cookies are not accepted yet, show popup
        if (typeof Cookies.get('accept_cookies') === 'undefined') {
            var popup = $('#cookie_popup');
            popup.addClass('show');
            $('.cookies_button').on('click', function () {
                popup.removeClass('show');
                Cookies.set('accept_cookies', 1);
            });
        }

        // Sort comments
        $('.sort-selector').on('click', function (e) {
            var sorter = e.target.id;
            sortBy(sorter);
        });

        // Click on flag
        $('.flag').on('click', function (e) {
            language = e.target.id;
            //Changing language and store in local storage
            changeLanguage(language);
            localStorage.setItem("language", language);
        });

        // Click on comment
        $('#comments').on('click', 'i', function (e) {
            var action = e.target.id.split('-')[0];
            var id = e.target.id.replace(action + '-', '');
            var votes = $('#vote-' + id);
            vote(action, id);

            // Increment/decrement vote when click on vote-arrow
            if (action === 'up' && !$(e.target).hasClass('disabled') && !ids.includes(id)) {
                votes.text(parseInt(votes.text()) + 1);
                $(e.target).addClass('fa-lg disabled');
                ids.push(id);
            } else if (action === 'down' && !$(e.target).hasClass('disabled') && !ids.includes(id)) {
                votes.text(parseInt(votes.text()) - 1);
                $(e.target).addClass('fa-lg disabled');
                ids.push(id);
            }
        });
    });
});

function getComments() {
    var deferred = $.Deferred();
    $.ajax({
        url: '../handler/commentHandler.php',
        type: 'GET',
        dataType: 'json',
        success: function success(result) {
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
function vote(action, id) {
    if (navigator.cookieEnabled && typeof Cookies.get('accept_cookies') !== 'undefined') {
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