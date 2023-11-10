<?php 
    if(isset($_SESSION['error'])){
?>

<div class="alert alert-danger" role="alert">
    <?php echo $_SESSION['error']; ?>
</div>

<?php
    unset($_SESSION['error']);
    }
?>

<?php 
    if(isset($_SESSION['message'])){
?>

<div class="alert alert-success" role="alert">
    <?php echo $_SESSION['message']; ?>
</div>

<?php
    unset($_SESSION['message']);
    }
?>