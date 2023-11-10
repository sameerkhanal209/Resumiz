<?php

$userid = isset($_GET['id']) ? $_GET['id'] : 0;

include('action.php');

$already = getResumeData($userid);

$page_title = isset($already['fname']) ? "Resume of " . $already['fname'] : "Resumiz";

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
<body class="resumiz-view">

<?php

include('resume.php')

?>

</body>

</html>