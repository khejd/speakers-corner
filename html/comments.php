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
    <div class="card">
        <div class="card-header">
            Speakers corner
        </div>
        <div class="card-body text-center">
            <br>
            <div class="container center_div">
                <?php
                $sql = "SELECT * FROM `comment`";
                $result = mysqli_query($conn, $sql);

                echo "<table class='table table-hover'>
                        <tbody>";

                while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
                    $id = $row['id'];
                    echo "<tr>
                            <td>" . $row['text'] . "</td>
                            <td>
                                <span onClick='upVote(".$id.")'><i class='fa fa-angle-up'></i></span>
                                <span id='vote-".$id."'>" . $row['vote'] . "</span>
                                <span onClick='downVote(".$id.")'><i class='fa fa-angle-down'></i></span>
                          </tr>";
                }

                echo "</tbody>
                </table>";
                ?>
                <a href="index.php" role="button" class="btn btn-secondary left">Hjem</a>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    function upVote(id) {
        $.ajax({
            url: "handler/upVoteHandler.php",
            type: 'POST',
            data: {id: id},
            success: function(data){
                $('#vote-' + id).text(parseInt($('#vote-' + id).text())+1);
            }
        })
    }

    function downVote(id) {
        $.ajax({
            url: "handler/downVoteHandler.php",
            type: 'POST',
            data: {id: id},
            success: function (data) {
                $('#vote-' + id).text(parseInt($('#vote-' + id).text())-1);
            }
        })
    }
</script>


</html>
