<?php
include('includes/dashboard-header.php');
?>

<?php

include('action.php');

$already = getResumeData($userid);

$experience = isset($already['experience']) ? json_decode($already['experience'], true) : [
    [
        "name" => "",
        "start" => "",
        "end" => "",
        "description" => ""
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $experience = $_POST['experience'] ?? '';

    $errors = 0;

    if(empty($experience)){
        $_SESSION['error'] = "Please enter your experience details";
        $errors++;
    }

    if ($errors === 0) {

        $jsexperience = json_encode($experience);

        $data = [
            "table" => "resume",
            "fields" => [
                "created_by" => $userid,
                "experience" => $jsexperience
            ],
            "where" => "created_by = $userid"
        ];

        if($already){
            $result = updateDatabase($data, "created_by = $userid");
        } else {
            $result = addToDatabase($data);
        }

        if($result){
            $_SESSION['message'] = "Your Resume is now complete!";
            header("Location: 1.php");
        } else {
            $_SESSION['error'] = "An error occured";
        }
    } 
}

?>

<div class="container">

<div class="container-bx">
    <?php include('includes/message.php') ?>
</div>

    <div class="heading">
        <h1>Create a new resume.</h1>
    </div>

    <div class="heading view-resume">
        <?php $view = "viewresume.php?id=$userid" ?>
        View your resume at: <a href="<?php echo $view ?>" target="_blank"><?php echo $view ?></a>
    </div>

    <div class="navigation">
        <div class="nav-box">
            <a href="1.php">Enter your details</a>
        </div>
        <div class="nav-box">
            <a href="2.php">Enter about yourself</a>
        </div>
        <div class="nav-box">
            <a href="3.php">Enter your skills</a>
        </div>

        <div class="nav-box">
            <a href="4.php">Enter your education</a>
        </div>
        <div class="nav-box active">
            <a href="5.php">Enter your job history</a>
        </div>
    </div>

    <div>
        <div class="left">
            
        <div class="card">
            <div class="card-title">Enter your experience details</div>
            
            <div class="card-body side-by-side">
                <form class="mw-400 auto-fill" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    
                
                <?php
                    $loop = 0;
                    foreach($experience as $edu){
                ?>

                <div class="<?php echo $loop == 0 ? 'to-add' : 'added' ?>" data-name="experience" data-total="<?php echo count($experience) ?>">
                <div class="form-group">
                        <label for="name">Job Name / Company:</label>
                        <input placeholder="Developer at Resumiz" class="u-full-width" type="text" id="name" name="experience[<?php echo $loop ?>][name]" value="<?php echo $edu['name'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="start">Started From:</label>
                        <input placeholder="2020" class="u-full-width" type="text" id="start" name="experience[<?php echo $loop ?>][start]" value="<?php echo $edu['start'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="end">Job Till:</label>
                        <input placeholder="now" class="u-full-width" type="text" id="end" name="experience[<?php echo $loop ?>][end]" value="<?php echo $edu['end'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Job Description:</label>
                        <input placeholder="Web developemnt job" class="u-full-width" type="text" id="description" name="experience[<?php echo $loop ?>][description]" value="<?php echo $edu['description'] ?>"/>
                    </div>

                    <hr>
                    
                    </div>

                    <?php
                        $loop++;
                        }
                    ?>

                    <div class="form-group">
                        <button type="button" class="btn btn-secondary btn-small u-full-width add-another">
                            Add Another +
                        </button>
                    </div>

                    <hr>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-small u-full-width">
                            Finish
                        </button>
                    </div>
                </form>
                <div class="right">
                   <?php
                        require('resume.php')
                   ?>
                </div>
            </div>
        </div>

        </div>
        
    </div>
</div>

<?php
include('includes/dashboard-footer.php');
?>