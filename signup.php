<?php include('includes/auth-header.php') ?>


<?php

include('action.php');

$fname = "";
$lname = "";
$email = "";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $errors = 0;

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

    if(empty($password)){
        $_SESSION['error'] = "Please enter a password";
        $errors++;
    }

    if ($errors === 0) {

        Signup($fname, $lname, $email, $password);

        $fname = "";
        $lname = "";
        $email = "";

        $_SESSION['message'] = "Signup successful for email: $email";
    } 
}
?>

<div class="head-heading">
    <h2>Signup for free account</h2>
</div>

<div class="container-bx">
<?php include('includes/message.php') ?>
</div>

<div class="auth_box box">
    <div class="left">
        
        <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="post" class="signup-form form-validate">
            
            <div class="form-group">
                <label for="fname">Your first name:</label>
                <input class="u-full-width" type="text" id="fname" name="fname" value="<?php echo $fname ?>" />
            </div>

            <div class="form-group">
                <label for="lname">Your last name:</label>
                <input class="u-full-width" type="text" id="lname" name="lname" value="<?php echo $lname ?>" />
            </div>

            <div class="form-group">
                <label for="email">Your email address:</label>
                <input class="u-full-width" type="text" id="email" name="email" value="<?php echo $email ?>"  />
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input class="u-full-width" type="password" id="password" name="password" />
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm your password:</label>
                <input class="u-full-width" type="password" id="confirm_password" name="confirm_password"/>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-small u-full-width">
                    Create Account
                </button>
            </div>
            
        </form>

    </div>
    <div class="right">

        <h3>Signup to get free resume.</h3>

        <ul class="features">
            <li>Create Resume</li>
            <li>Download Resume</li>
            <li>Share Resume</li>
        </ul>

    </div>
</div>

<div class="detail-box box">
    <div class="left-side">
        <h2>Already have an account?</h2>
        <p>Login to enjoy all the dashboard features.</p>
    </div>
    <div class="right-side">
        <a href="login.php" class="btn btn-primary btn-sm">Login!</a>
    </div>
</div>

<?php include('includes/auth-footer.php') ?>