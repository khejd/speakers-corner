'use strict';

$(function () {
    changeLanguage(localStorage.getItem("language"));
});

/** @param{string} name*/
function getCookie(name) {
    return Cookies.getJSON(name);
}

/** @param{comment} commentVar */
function wilsonScore(commentVar) {
    var N = parseInt(commentVar['ups']) + parseInt(commentVar['downs']);
    if (N === 0) {
        return 0.65;
    }
    var Z = 1.28155156;
    var P = parseInt(commentVar['ups']) / N;
    var LEFT = P + 1 / (2 * N) * Z * Z;
    var RIGHT = Z * Math.sqrt(P * (1 - P) / N + Z * Z / (4 * N * N));
    var UNDER = 1 + 1 / N * Z * Z;
    return (LEFT - RIGHT) / UNDER;
}

/** @param{int} x*/
function sigmoid(x) {
    return Math.exp(x) / (Math.exp(x) + 1);
}

/** @param{comment} commentVar */
function wilsonScoreWithTime(commentVar) {
    var SECONDS = new Date().getTime() / 1000 - new Date(commentVar['time']) / 1000;
    var DAYS = SECONDS / (3600 * 24);

    if (SECONDS < 4 * 60 * 60) {
        return 1 - 1.5 * sigmoid(0.6 * (DAYS - 6)); //alle kommentarer som er yngre enn 4 timer sorteres kun etter tid.
    }
    return wilsonScore(commentVar) - 1.5 * sigmoid(0.6 * (DAYS - 6)); //ellers brukes willsonscore med tid
}

/** @param{string} argument */
function sortBy(argument) {
    if (argument === "time") {
        comments.sort(function (a, b) {
            var d1 = new Date(a['time']);
            var d2 = new Date(b['time']);
            return d1 > d2 ? -1 : 1;
        });
    } else if (argument === "popularity") {
        comments.sort(function (a, b) {
            var A = parseInt(a['ups']) - parseInt(a['downs']);
            var B = parseInt(b['ups']) - parseInt(b['downs']);
            if (A === B) {
                var d1 = new Date(a['time']);
                var d2 = new Date(b['time']);
                return d1 > d2 ? -1 : 1;
            }
            return B - A;
        });
    } else if (argument === "trending") {
        comments.sort(function (a, b) {
            return wilsonScoreWithTime(b) - wilsonScoreWithTime(a);
        });
    }
    updateTable();
}

function updateTable() {
    var COOKIE = getCookie('vote');

    var cards = "<div class='card-columns' id='comments-cards'>";
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
        for (var _iterator = comments[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var arg = _step.value;

            var disable = false;
            var bold = '';

            if (location.pathname === '/comment/') {
                cards += "<div class='card'>" + "<div class='row'><div class='col-10 col-md-8 col-sm-8 col-lg-10'>" + "<blockquote class='blockquote mb-0 card-body'>" + "<p>" + arg[1] + "</p>" + "</blockquote>" + "</div></div></div>";
            } else {
                // Highlight vote arrow if already voted
                if (typeof COOKIE !== 'undefined') {
                    for (var i = 0; i < COOKIE.length; i++) {
                        if (COOKIE[i]['id'] === arg['id']) {
                            disable = true;
                            bold = COOKIE[i]['vote'];
                        }
                    }
                }
                var VOTES = parseInt(arg['ups']) - parseInt(arg['downs']);

                cards += "<div class='card'>" + "<div class='row'><div class='col-10 col-md-8 col-sm-8 col-lg-10'>" + "<blockquote class='mb-0 card-body'>" + "<p>" + arg[1] + "</p>" + "</blockquote>" + "</div><div class='col-2'>" + "<span class='votes'>" + "<i id='up-" + arg['id'] + "' class='fa fa-sort-up" + (bold === 'up' ? ' fa-lg ' : ' ') + "param mr-2" + (disable ? ' disabled ' : ' ') + "'></i>" + "<div id='vote-" + arg['id'] + "' class='mr-2'>" + VOTES + "</div>" + "<i id='down-" + arg['id'] + "' class='fa fa-sort-down" + (bold === 'down' ? ' fa-lg ' : ' ') + "param mr-2" + (disable ? ' disabled ' : ' ') + "'></i>" + "</span>" + "</div></div></div>";
            }
        }
    } catch (err) {
        _didIteratorError = true;
        _iteratorError = err;
    } finally {
        try {
            if (!_iteratorNormalCompletion && _iterator.return) {
                _iterator.return();
            }
        } finally {
            if (_didIteratorError) {
                throw _iteratorError;
            }
        }
    }

    cards += "</div>";
    $('#comments-cards').remove();
    $('#comments').append(cards);
}