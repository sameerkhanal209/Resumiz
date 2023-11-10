<?php
include('includes/dashboard-header.php');
?>

<?php

include('action.php');

$already = getResumeData($userid);

$pfname = isset($already['fname']) ? $already['fname'] : "";
$plname = isset($already['lname']) ? $already['lname'] : "";
$pemail = isset($already['email']) ? $already['email'] : "";
$phone = isset($already['phone']) ? $already['phone'] : "";
$address = isset($already['address']) ? $already['address'] : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pfname = $_POST['fname'] ?? '';
    $plname = $_POST['lname'] ?? '';
    $pemail = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    $files = $_FILES['image'];

    $errors = 0;

    if(isset($files['name']) && !empty($files['name'])){
        
        $filename = $files['name'];
        $filesize = $files['size'];

        $fileTempLocation = $files['tmp_name'];

        if($filesize > 200000000){
            $_SESSION['error'] = "File has the size $filesize which exceeds the limit. It cannot be uploaded.";
            $errors++;
        }

        $file_name_and_extension = explode('.', $filename);

        $newName = uniqid() . ".".$file_name_and_extension[1];

        move_uploaded_file($fileTempLocation, "uploads/".$newName);

    } else {
        $_SESSION['error'] = "Please select an resume image";
        $errors++;
    }

    if(empty($fname)){
        $_SESSION['error'] = "Please enter your first name";
        $errors++;
    }

    if(empty($lname)){
        $_SESSION['error'] = "Please enter your last name";
        $errors++;
    }

    if(empty($email)){
        $_SESSION['error'] = "Please enter your email";
        $errors++;
    }

    if(empty($phone)){
        $_SESSION['error'] = "Please enter your phone";
        $errors++;
    }

    if(empty($address)){
        $_SESSION['error'] = "Please enter your address";
        $errors++;
    }

    if ($errors === 0) {

        $data = [
            "table" => "resume",
            "fields" => [
                "created_by" => $userid,
                "fname" => $pfname,
                "lname" => $plname,
                "email" => $pemail,
                "phone" => $phone,
                "address" => $address,
                "photo" => $newName
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
            header("Location: 2.php");
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
        <div>
            <?php $view = "viewresume.php?id=$userid" ?>
            View your resume at: <a href="<?php echo $view ?>" target="_blank"><?php echo $view ?></a>
        </div>
    </div>

    <form class="heading view-resume" method="post" action="email.php">
        <button type="submit" class="btn btn-secondary btn-gred-active">Email me this CV</button>
    </form>

    <div class="navigation">
        <div class="nav-box active">
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
                        <label for="image">Your Image:</label>
                        <input type="file" name="image" id="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="fname">Your first name:</label>
                        <input class="u-full-width" type="text" id="fname" name="fname" value="<?php echo $pfname ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="lname">Your last name:</label>
                        <input class="u-full-width" type="text" id="lname" name="lname" value="<?php echo $plname ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Your email:</label>
                        <input class="u-full-width" type="text" id="email" name="email" value="<?php echo $pemail ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input class="u-full-width" type="text" id="phone" name="phone" value="<?php echo $phone ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input class="u-full-width" type="text" id="address" name="address" value="<?php echo $address ?>"/>
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