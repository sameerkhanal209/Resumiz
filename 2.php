<?php
include('includes/dashboard-header.php');
?>

<?php

include('action.php');

$already = getResumeData($userid);

$description = isset($already['description']) ? $already['description'] : "";
$title = isset($already['title']) ? $already['title'] : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $description = $_POST['description'] ?? '';
    $title = $_POST['title'] ?? '';

    $errors = 0;

    if(empty($description)){
        $_SESSION['error'] = "Please enter your description";
        $errors++;
    }

    if(empty($title)){
        $_SESSION['error'] = "Please enter your title";
        $errors++;
    }

    if ($errors === 0) {

        $data = [
            "table" => "resume",
            "fields" => [
                "created_by" => $userid,
                "description" => $description,
                "title" => $title,
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
            header("Location: 3.php");
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
        <div class="nav-box active">
            <a href="2.php">Enter about yourself</a>
        </div>
        <div class="nav-box">
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
                <form class="mw-400 auto-fill" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    
                    <div class="form-group">
                        <label for="title">Your Title:</label>
                        <input class="u-full-width" type="text" id="title" name="title" value="<?php echo $title ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="description">Your Description:</label>
                        <textarea class="u-full-width" type="text" id="description" name="description"><?php echo $description ?></textarea>
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