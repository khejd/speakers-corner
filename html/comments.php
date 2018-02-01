<?php include_once("../Connections/connection.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <title>Speakers-corner test site</title>

</head>
<body>
    <div class="comments">
        <?php
        $sql = "SELECT * FROM comment";
        $result = mysqli_query($conn, $sql);

        echo "<table>";
        echo "<tr><th>Kommentar</th></tr>";

        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
            echo "<tr><td>" . $row['text'] . "</td><td>" . $row['vote'] . "</td></tr>";
        }

        echo "</table>";
        ?>

    </div>

    <a href="index.php"><button>Gå til startside</button></a>
</body>
</html>
