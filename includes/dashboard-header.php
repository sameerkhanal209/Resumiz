<?php
    include('session.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : "Resumiz" ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/styles/style.css">

</head>
<body>


<header>
    
    <div class="navbar">
        <div class=" nav-flex">

            <div class="logo-menu">
                <div class="logo-holder">
                    <h2 class="logo"><a href="/">Resumiz.</a></h2>
                </div>
                <nav class="menu">
                    <ul>
                        <li><a href="/" target="_blank"><i class="fa-solid fa-house"></i> Home</a></li>
                        <li><a href="/"> Create Resume</a></li>
                    </ul>
                </nav>
            </div>

            <div class="profile">
                <a href="/dashboard/profile">
                    <img src="https://www.gravatar.com/avatar/6e8a5e0eb314f4e04ccaf36a57dff572?r=pg&amp;d=retro">
                    <div>
                        <?php echo $fname ?>
                        <?php echo $lname ?>  
                                                 
                        <span><?php echo $email ?> </span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</header>

<div class="main-holder">
<?php include('dashboard-menu.php') ?>

<main class="main">
