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
<a href="#" class="sort_selecter" onclick= "sortBy('popularity')" >Most recent</a>
<a href="#" class="sort_selecter"onclick="sortBy('time')">Most Populare</a> 
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

                function cmpByPopularity($a, $b)
                {
                    return (($a["ups"]-$a["downs"])>($b["ups"]-$b["downs"])) ? -1:1;
                }

                function cmpByTimeAndVote($a, $b){
                    $score_a = wilsonScore($a);
                    $score_b = wilsonScore($b);

                    if ($score_a == $score_b) {
                        return 0;
                    }
                    return ($score_a > $score_b) ? -1 : 1;
                }

                function wilsonScore($commentVar){
                    $n = $commentVar["ups"] + $commentVar["downs"];
                    if ($n==0) {
                        return 0;
                    }
                    $z = 1.28155156;
                    $p = $commentVar["ups"]/$n;
                    $left = $p + 1/(2*$n)*$z*$z;
                    $right = $z*sqrt($p*(1-$p)/$n +  $z*$z/(4*$n*$n));
                    $under = 1+ (1/$n)*$z*$z;
                    return ($left-$right)/$under;
                }

                $newArray = array();

                while ($row = mysqli_fetch_array($result)){
                    echo strtotime($row["time"])-time();
                    array_push($newArray, $row);
                }

                usort($newArray, "cmpByTimeAndVote");
                

                

                echo "<table class='table table-hover table-sort5000'>
                        <tbody>";

                foreach ($newArray as $row){   //Creates a loop to loop through results
                    $id = $row['id'];
                    $value = intval($row['ups']) - intval($row['downs']);
                    echo "<tr>
                            <td>" . $row['text'] . "</td>
                            <td>
                                <span onClick='upVote(".$id.")'><i class='fa fa-angle-up'></i></span>
                                <span id='vote-".$id."'>" . $value . "</span>
                                <span onClick='downVote(".$id.")'><i class='fa fa-angle-down'></i></span>
                          </tr>";
                }

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
console.log(ar);

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
            return a['ups']-a['downs'] -(b['ups']-b['downs']);
        });
    }
    console.log(ar);
    var table = arrayToTable(ar, {
    thead: true,
    attrs: {class: 'table'}
    });

    $('table-sort5000').replaceWith(table);
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

    function downVote(id) {
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
var arrayToTable = function (data, options) {

    "use strict";

    var table = $('<table />'),
        thead,
        tfoot,
        rows = [],
        row,
        i,
        j,
        defaults = {
            th: true, // should we use th elemenst for the first row
            thead: false, //should we incldue a thead element with the first row
            tfoot: false, // should we include a tfoot element with the last row
            attrs: {} // attributes for the table element, can be used to
        };

    options = $.extend(defaults, options);

    table.attr(options.attrs);

    // loop through all the rows, we will deal with tfoot and thead later
    for (i = 0; i < data.length; i = i + 1) {
        row = $('<tr />');
        for (j = 0; j < data[i].length; j = j + 1) {
            if (i === 0 && options.th) {
                row.append($('<th />').html(data[i][j]));
            } else {
                row.append($('<td />').html(data[i][j]));
            }
        }
        rows.push(row);
    }

    // if we want a thead use shift to get it
    if (options.thead) {
        thead = rows.shift();
        thead = $('<thead />').append(thead);
        table.append(thead);
    }

    // if we want a tfoot then pop it off for later use
    if (options.tfoot) {
        tfoot = rows.pop();
    }

    // add all the rows
    for (i = 0; i < rows.length; i = i + 1) {
        table.append(rows[i]);
    }

    // and finally add the footer if needed
    if (options.tfoot) {
        tfoot = $('<tfoot />').append(tfoot);
        table.append(tfoot);
    }

    return table;
};

</script>


</html>
