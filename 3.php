<?php
include('includes/dashboard-header.php');
?>

<?php

include('action.php');

$already = getResumeData($userid);

$skills = isset($already['skills']) ? $already['skills'] : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $skills = $_POST['skills'] ?? '';

    $errors = 0;
    if(empty($skills)){
        $_SESSION['error'] = "Please enter your skills";
        $errors++;
    }

    if ($errors === 0) {

        $data = [
            "table" => "resume",
            "fields" => [
                "created_by" => $userid,
                "skills" => $skills,
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
            header("Location: 4.php");
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
        <div class="nav-box active">
            <a href="3.php">Enter your skills</a>
        </div>

        <div class="nav-box">
            <a href="4.php">Enter your education</a>
        </div>
        <div class="nav-box">
            <a href="5.php">Enter your job history</a>
        </div>
    </div>

    <div>
        <div class="left">
            
        <div class="card">
            <div class="card-title">Enter your details</div>
            
            <div class="card-body side-by-side">
                <form class="mw-400 auto-fill" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <label for="fname">Add Skills (Separate by comma):</label>
                        <input class="u-full-width" placeholder="HTML, Javascript, CSS" type="text" id="skills" name="skills" value="<?php echo $skills ?>"/>
                    </div>

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