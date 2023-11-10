<?php
include('includes/dashboard-header.php');
?>

<?php

include('action.php');

$already = getResumeData($userid);

$education = isset($already['education']) ? json_decode($already['education'], true) : [
    [
        "name" => "",
        "start" => "",
        "end" => "",
        "type" => "",
        "degree" => ""
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $education = $_POST['education'] ?? '';


    $errors = 0;

    if(empty($education)){
        $_SESSION['error'] = "Please enter your education details";
        $errors++;
    }

    if ($errors === 0) {

        $jseducation = json_encode($education);

        $data = [
            "table" => "resume",
            "fields" => [
                "created_by" => $userid,
                "education" => $jseducation
            ],
            "where" => "created_by = $userid"
        ];

        if($already){
            $result = updateDatabase($data, "created_by = $userid");
        } else {
            $result = addToDatabase($data);
        }

        if($result){
            $_SESSION['message'] = "Saved your details successfully";
            header("Location: 5.php");
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

        <div class="nav-box active">
            <a href="4.php">Enter your education</a>
        </div>
        <div class="nav-box">
            <a href="5.php">Enter your job history</a>
        </div>
    </div>

    <div>
        <div class="left">
            
        <div class="card">
            <div class="card-title">Enter your education details</div>
            
            <div class="card-body side-by-side">
                <form class="mw-400 auto-fill" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    
                
                <?php
                    $loop = 0;
                    foreach($education as $edu){
                ?>

                <div class="<?php echo $loop == 0 ? 'to-add' : 'added' ?>" data-name="education" data-total="<?php echo count($education) ?>">
                <div class="form-group">
                        <label for="name">Education Name:</label>
                        <input placeholder="Something College" class="u-full-width" type="text" id="name" name="education[<?php echo $loop ?>][name]" value="<?php echo $edu['name'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="start">Starting From:</label>
                        <input placeholder="2020" class="u-full-width" type="text" id="start" name="education[<?php echo $loop ?>][start]" value="<?php echo $edu['start'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="end">Starting To:</label>
                        <input placeholder="2024" class="u-full-width" type="text" id="end" name="education[<?php echo $loop ?>][end]" value="<?php echo $edu['end'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="type">Type of degree:</label>
                        <input placeholder="+2/Batchleor" class="u-full-width" type="text" id="type" name="education[<?php echo $loop ?>][type]" value="<?php echo $edu['type'] ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="degree">Degree:</label>
                        <input placeholder="Science/B. Tech" class="u-full-width" type="text" id="degree" name="education[<?php echo $loop ?>][degree]" value="<?php echo $edu['degree'] ?>"/>
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
                            Next
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