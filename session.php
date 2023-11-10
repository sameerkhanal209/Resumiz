<?php

session_start();

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];

    $fname = $user['fname'];
    $lname = $user['lname'];
    $email = $user['email'];

    $userid = $user['id'];

}

?>