/** @param{string} name*/
function getCookie(name){
    return Cookies.getJSON(name);
}

/** @param{comment} commentVar */
function wilsonScore(commentVar){
    const N = commentVar['ups'] + commentVar['downs'];
    if (N===0) {
        return 0;
    }
    const Z = 1.28155156;
    const P = commentVar['ups']/N;
    const LEFT = P + 1/(2*N)*Z*Z;
    const RIGHT = Z*Math.sqrt(P*(1-P)/N + Z*Z/(4*N*N));
    const UNDER = 1+ (1/N)*Z*Z;
    return (LEFT-RIGHT)/UNDER;
}

/** @param{comment} commentVar */
function hot(commentVar) {
    const S = commentVar['ups']-commentVar['downs'];
    const ORDER = Math.log10(Math.max(Math.abs(s),1));
    const SIGN = (S > 0) ? 1 : -1;
    const SECONDS = new Date().getTime()/1000 - commentVar['time']/1000;
    return ORDER + SIGN*SECONDS/45000;
}

/** @param{comment} commentVar */
function wilsonScoreWithTime(commentVar){
    const SECONDS = new Date().getTime()/1000 - commentVar['time']/1000;
    return wilsonScore(commentVar)//-Math.log10(SECONDS);
}

/** @param{string} argument */
function sortBy(argument){
    if (argument === "time"){
        comments.sort((a, b) => {
            let d1 = new Date(a['time']);
            let d2 = new Date(b['time']);
            return (d1 > d2) ? -1 : 1;
        });
    } else if (argument === "popularity"){
        comments.sort((a,b) => {
                const A = parseInt(a['ups'])-parseInt(a['downs']);
                const B = parseInt(b['ups'])-parseInt(b['downs']);
                if (A === B){
                    let d1 = new Date(a['time']);
                    let d2 = new Date(b['time']);
                    return (d1 > d2) ? -1 : 1;
                }
                return B-A;
            }
        );
    } else if (argument === "trending"){
        comments.sort((a,b) => wilsonScoreWithTime(b) - wilsonScoreWithTime(a));
    }
    updateTable();
}

function updateTable(){
    const COOKIE = getCookie('vote');

    let table = "<table class='table' id='comments-table'><tbody>";
    for (let arg of comments){
        let disable = false;
        let bold = '';

        // Highlight vote arrow if already voted
        if (typeof COOKIE !== 'undefined'){
            for (let i = 0; i < COOKIE.length; i++){
                if (COOKIE[i]['id'] === arg['id']){
                    disable = true;
                    bold = COOKIE[i]['vote'];
                }
            }
        }
        const VOTES =  parseInt(arg['ups'])-parseInt(arg['downs']);

        table += (
            "<tr><td>" + arg[1] +
            "<td>" +
            "<span><i id='up-" + arg['id'] + "' class='fa fa-angle-up " + (bold === 'up' ? 'fa-lg' : '') + " param " + (disable ? 'disabled' : '') + "'></i></span>" +
            "<span id='vote-" + arg['id'] + "'>" + VOTES + "</span>" +
            "<span><i id='down-" + arg['id'] + "' class='fa fa-angle-down " + (bold === 'down' ? 'fa-lg' : '') + " param " + (disable ? 'disabled' : '') + "'></i></span>"
        );

    }
    table += "</table>";
    $('#comments-table').remove();
    $('#comments').append(table);
}
