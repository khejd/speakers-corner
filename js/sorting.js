function wilsonScore(commentVar){
    var n = commentVar['ups'] + commentVar['downs'];
    if (n===0) {
        return 0;
    }
    var z = 1.28155156;
    var p = commentVar["ups"]/n;
    var left = p + 1/(2*n)*z*z;
    var right = z*Math.sqrt(p*(1-p)/n +  z*z/(4*n*n));
    var under = 1+ (1/n)*z*z;
    return (left-right)/under;
}

function hot(commentVar) {
    var s = commentVar['ups']-commentVar['downs'];
    var order = Math.log10(Math.max(Math.abs(s),1));
    var sign = 0;
    if (s>0){
        sign = 1;
    }
    if (s<0){
        sign =-1;
    }
    var seconds = new Date().getTime()/1000 - commentVar['time']/1000;
    return order + sign*seconds/45000;
}

function wilsonScoreWithTime(commentVar){
    var seconds = new Date().getTime()/1000 - commentVar['time']/1000;
    return wilsonScore(commentVar)//-Math.log10(seconds);
}

function sortBy(argument){
    if (argument === "time"){
        myArray.sort(function(a, b){
            var d1 = new Date(a['time']);
            var d2 = new Date(b['time']);
            return d1 > d2 ? -1:1;
        });
    }
    if (argument === "popularity"){
        myArray.sort(function(a,b){
                var va = parseInt(a['ups'])-parseInt(a['downs']);
                var vb = parseInt(b['ups'])-parseInt(b['downs']);
                if (va === vb){
                    var d1 = new Date(a['time']);
                    var d2 = new Date(b['time']);
                    return d1> d2 ? -1:1;
                }
                return vb-va;
            }
        );
    }

    if (argument === "trending"){
        myArray.sort(function(a,b){
            return wilsonScoreWithTime(b)-wilsonScoreWithTime(a);
        });
    }

    var table = "<tbody>";
    for (let arg of myArray){
        var votes =  parseInt(arg['ups'])-parseInt(arg['downs']);
        table += (
            "<tr><td>" + arg[1] + "</td><td>" +
            "<span id='up-" + arg['id'] + "'><i class='fa fa-angle-up param'></i></span>" +
            "<span id='vote-" + arg['id'] + "'>" + votes + "</span>" +
            "<span id='down-" + arg['id'] + "'><i class='fa fa-angle-down param'></i></span></tr>"
        );
    }
    table += "</tbody></table>";
    document.getElementById('comments-table').innerHTML=table;

    return 0;
}
