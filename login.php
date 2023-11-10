<?php include('includes/auth-header.php') ?>

<?php

include('action.php');

$email = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $errors = 0;

    if(empty($email)){
        $_SESSION['error'] = "Please enter your email";
        $errors++;
    }

    if(empty($password)){
        $_SESSION['error'] = "Please enter a password";
        $errors++;
    }

    if ($errors === 0) {

        Login($email, $password);

        //$_SESSION['message'] = "Login successful for email: $email";
    } 
}
?>

<div class="head-heading">
    <h2>Login to your dashboard</h2>
</div>

<div class="container-bx">
<?php include('includes/message.php') ?>
</div>

<div class="auth_box box">
    <div class="left">
        
        <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="post" class="login-form form-validate">

            <div class="form-group">
                <label for="email">Your email address:</label>
                <input class="u-full-width" type="text" id="email" name="email" value="<?php echo $email ?>" />
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input class="u-full-width" type="password" id="password" name="password" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-small u-full-width">
                    Log In
                </button>
            </div>
            
        </form>

    </div>
    <div class="right">

        <h3>Features</h3>
        <ul class="features">
            <li>Create Resume</li>
            <li>Download Resume</li>
            <li>Share Resume</li>
        </ul>

    </div>
</div>

<div class="detail-box box">
    <div class="left-side">
        <h2>Don't have an account?</h2>
        <p>Signup now to generate free resume.</p>
    </div>
    <div class="right-side">
        <a href="signup.php" class="btn btn-primary btn-sm">Signup Now!</a>
    </div>
</div>

<?php include('includes/auth-footer.php') ?>
