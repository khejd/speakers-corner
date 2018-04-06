<?php
include_once("../../Connections/connection.php");

session_start();

function getLoggedIn(){
    if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']){
        throw new Exception('Not logged in');
    }
}

try {
    getLoggedIn();
    echo json_encode(array(
        'error' => false
    ));
} catch (Exception $e) {
    echo json_encode(array(
        'error' => true,
        'msg' => $e->getMessage()
    ));
}
