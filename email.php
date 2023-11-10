<?php

include('session.php');

function send_email(){

    $to = $_SESSION['user']['email'];

    $link = "http://myclass.local/Project/viewresume.php?id=".$_SESSION['user']['id'];

    $subject = "Your CV";
    $message = "You can see your CV at $link. Sent from Resumiz.";

    $headers = 'From: sameerkhanal2099@gmail.com' . "\r\n" .
           'Reply-To: sameerkhanal2099@gmail.com' . "\r\n" .
           'X-Mailer: ./Resumiz';

    if(mail($to, $subject, $message, $headers)) {
        $_SESSION['message'] = "CV Mail sent successfully to $to";
        header("Location: 1.php");

    } else {
        $_SESSION['error'] = "CV Mail sending failed to $to";
        header("Location: 1.php");
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    send_email();
    
}
?>