<?php

$fname = isset($already['fname']) ? $already['fname'] : "Your";
$lname = isset($already['lname']) ? $already['lname'] : "Name";
$phone = isset($already['phone']) ? $already['phone'] : "1234567890";
$email = isset($already['email']) ? $already['email'] : "test@resumiz.com";
$address = isset($already['address']) ? $already['address'] : "123, Street, City, State, Country";

$photo = isset($already['photo']) ? "uploads/" . $already['photo'] : "https://www.gravatar.com/avatar/6e8a5e0eb314f4e04ccaf36a57dff572?r=pg&d=retro";

$description = isset($already['description']) ? $already['description'] : "I am a web develoepr and designer with knowledge in many different languages";
$title = isset($already['title']) ? $already['title'] : "Web Developer/Designer";

$education = isset($already['education']) ? json_decode($already['education'], true) : [[
    "name" => "Lovely Professional University",
    "degree" => "B.Tech",
    "type" => "degree",
    "start" => "2020",
    "end" => "2024",
],
[
    "name" => "Something College",
    "degree" => "Science",
    "type" => "batchelor",
    "start" => "2018",
    "end" => "2020",
]];
$skills = isset($already['skills']) ? explode(",", $already['skills']) : [
    "PHP",
    "Javascript",
    "MySql",
    "Laravel",
    "HTML",
    "CSS"
];
$experience = isset($already['experience']) ? json_decode($already['experience'], true) : [
    [
        "name" => "Developer at Aeonfree",
        "description" => "A cool web design company",
        "start" => "2020",
        "end" => "2021",
    ],
    [
        "name" => "Intern at Random Company",
        "description" => "A cool web design company",
        "start" => "2020",
        "end" => "2021",
    ]
];


?>


<div class="resume">
    <div class="left">
            <img src="<?php echo $photo; ?>">
            <h3>Contact</h3>
            <div class="contact">
                <h4>Phone</h4>
                <div class="phone mb" id="s-phone"><i class="fa-solid fa-phone"></i> <?php echo $phone; ?></div>

                <h4>Email</h4>
                <div class="email mb" id="s-email"><i class="fa-solid fa-envelope"></i> <?php echo $email; ?></div>

                <h4>Address</h4>
                <div class="address mb" id="s-address"><i class="fa-solid fa-map-marker"></i> <?php echo $address; ?></div>
            </div>

            <h3>Education</h3>
            <?php
                foreach ($education as $edu) {
            ?>
                <div class="education mb">
                    <div class="s-date"><strong><?php echo $edu['start'] ?> - <?php echo $edu['end'] ?> </strong></div>
                    <div class="s-name"><h5><?php echo $edu['name'] ?></h5></div>
                    <div class="s-degree"><?php echo $edu['degree'] ?> (<?php echo ucfirst($edu['type']) ?>) </div>
                </div>

            <?php
                }
            ?>

            <h3>Skills</h3>

            <ul id="skills">
            <?php
                foreach ($skills as $skill) {
            ?>
                <li><?php echo $skill ?></li>
            <?php
                }
            ?>   
            </ul>   

    </div>
    <div class="right">
        <h1 class="name"><span class="fname" id="s-fname"><?php echo $fname; ?></span> <span id="s-lname" class="lname"><?php echo $lname; ?></span></h1>
        <h2 class="title" id="s-title"><?php echo $title ?></h2>
        <p class="description" id="s-description"><?php echo $description ?></p>

        <h3 class="exp-title">Experience</h3>
        <?php
            foreach ($experience as $exp) {
        ?>
            <div class="experience">
                <div class="date"><?php echo $exp['start'] ?> - <?php echo $exp['end'] ?> </div>
                <div class="name"><?php echo $exp['name'] ?> </div>
                <div class="description"><?php echo $exp['description'] ?> </div>
            </div>
        <?php
            }
        ?>
    </div>
</div>
