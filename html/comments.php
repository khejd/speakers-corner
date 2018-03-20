<?php include_once("../Connections/connection.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <title>Speakers-corner test site</title>

</head>
<body>
<br>
<div class="container">

<a href="#" class="sort_selecter" onclick= "sortBy('trending')">Trending</a>
<a href="#" class="sort_selecter" onclick= "sortBy('popularity')" >Most Populare</a>
<a href="#" class="sort_selecter" onclick=  "sortBy('time')">Most Recent</a> 
    <div class = "card">
        <div class="card-header">
            Speakers corner
        </div>
        <div class="card-body text-center">
            <br>
            <div class="container center_div">
                <?php
                
                $sql = "SELECT * FROM `comment` ORDER BY `time` LIMIT 20";
                $result = mysqli_query($conn, $sql);


                

                $newArray = array();

                while ($row = mysqli_fetch_array($result)){
                    
                    array_push($newArray, $row);
                }

                usort($newArray, "cmpByTimeAndVote");
                

                

                echo "<table class='table table-hover' id = 'table-sort-id'>
                        <tbody>";

                
                echo "</tbody>
                </table>";

                json_encode($newArray); 
                ?>
                <a href="index.php" role="button" class="btn btn-secondary left">Hjem</a>
            </div>
        </div>
    </div>
</div>

</body>

<script>

var ar = <?php echo json_encode($newArray) ?>;
function wilsonScore(commentVar){
                    var n = commentVar["ups"] + commentVar["downs"];
                    if (n==0) {
                        return 0;
                    }
                    var z = 1.28155156;
                    var p = commentVar["ups"]/n;
                    var left = p + 1/(2*n)*z*z;
                    var right = z*Math.sqrt(p*(1-p)/n +  z*z/(4*n*n));
                    var under = 1+ (1/n)*z*z;
                    return (left-right)/under;
                }

function hot(commentVar)
{
    var s = commentVar['ups']-commentVar['downs'];
    var order = Math.log10(Math.max(Math.abs(s),1)); 
    var sign = 0;
    if (s>0)
    {
        sign = 1;
    }
    if (s<0)
    {
        sign =-1;
    }
    var seconds = new Date().getTime()/1000 - commentVar['time']/1000;
    return order + sign*seconds/45000;

}

function wilsonScoreWithTime(commentVar)
{
    var seconds = new Date().getTime()/1000 - commentVar['time']/1000;
    return wilsonScore(commentVar)//-Math.log10(seconds);
}

function sortBy(argument)
{

    if (argument=="time")
    {
        ar.sort(function(a, b)
            {
                var d1 = new Date(a['time']);
                var d2 = new Date(b['time']);
                return d1> d2 ? -1:1;
            });
    }
    if (argument=="popularity")
    {
        ar.sort(function(a,b)
        {
            var va = Number(a['ups'])-Number(a['downs']);
            var vb = Number(b['ups'])-Number(b['downs']);
            if (va==vb)
            {
                var d1 = new Date(a['time']);
                var d2 = new Date(b['time']);
                return d1> d2 ? -1:1;

            }
            return vb-va;
        }
        );
    }
    if (argument == "trending")
    {
       
        ar.sort(function(a,b){return wilsonScoreWithTime(b)-wilsonScoreWithTime(a);});
    }

    var table = "<tbody>";
    for (let arg of ar)
    {
        var votes =  Number(arg['ups'])-Number(arg['downs']);
       
       table += ("<tr>                            <td>" +arg[1] + "</td>                            <td>                                <span onClick='upVote("+arg['id']+")'><i class='fa fa-angle-up'></i></span>                                <span id='vote-"+arg['id']+"'>" +votes+ "</span>                                <span onClick='downVote("+arg['id']+")'><i class='fa fa-angle-down'></i></span>                          </tr>") 

    }
    table += "</tbody></table>";

    document.getElementById('table-sort-id').innerHTML=table;
    
    
}





    function upVote(id) {
        $.ajax({
            url: "handler/upVoteHandler.php",
            type: 'POST',
            data: {id: id},
            success: function(result){
                if (result == 'up'){
                    $('#vote-' + id).text(parseInt($('#vote-' + id).text())+1);
                }
            }
        })
    }

    function downVote(id) 
    {
        $.ajax({
            url: "handler/downVoteHandler.php",
            type: 'POST',
            data: {id: id},
            success: function (result) {
                if (result == 'down'){
                    $('#vote-' + id).text(parseInt($('#vote-' + id).text())-1);
                }
            }
        })
    }


    //sorter listen forstegang
    sortBy("trending");


</script>


</html>
