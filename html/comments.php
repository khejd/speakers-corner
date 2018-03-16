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
                

                

                echo "<table class='table table-hover' id = 'table-sort-id'>
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
            return (a['ups']-a['downs']) < (b['ups']-b['downs']) ? 1 : -1;
        });
    }
    console.log(ar);
    var table = "";
    for (let arg of ar)
    {
        console.log("arg-comment =" +arg[1] +" vote = " +(arg['ups']-arg['downs']);
        table +="<tr> <td>";
        table += arg[1];
        table += "</td></tr>";
        

    }

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


</script>


</html>
