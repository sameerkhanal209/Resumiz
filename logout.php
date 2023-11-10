<?php

session_start();

unset($_SESSION['user']);
$_SESSION['message'] = "You have been logged out";

header("Location: login.php");

?>