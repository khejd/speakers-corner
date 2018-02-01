<?php
include_once("../Connections/connection.php");

if (isset($_POST['submit'])){

    $x = 4; // Amount of digits
    $min = pow(10,$x);
    $max = pow(10,$x+1)-1;
    $code = rand($min, $max);

    $phone = $_POST['phone'];
    $sql = "INSERT INTO user (phone_number, code) VALUES ('$phone', '$code')";
    if(!mysqli_query($conn,$sql)){
        echo "Not inserted";
    } else {
        echo "Inserted";
    }
}

?>
