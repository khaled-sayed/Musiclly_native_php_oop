<?php
ob_start();
if (isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];

    echo "<script> userLoggedIn = '$userLoggedIn';</script>";
} else {
    header("location: login.php");
}
?>
<!DOCTYPE "html">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $getTitle; ?></title>
    <link rel='stylesheet' href='layout/css/all.min.css'>
    <link rel='stylesheet' href='layout/css/all.min.font.css'>
    <link rel='stylesheet' href='layout/css/bootstrap.min.css'>
    <link rel='stylesheet' href='layout/css/bootstrap-grid.min.css'>
    <link rel='stylesheet' href='layout/css/jquery-ui.css'>
    <link rel='stylesheet' href='layout/css/jquery.selectBoxIt.css'>
    <link rel='stylesheet' href='layout/css/backend.css'>
    <script src="layout/js/jquery-3.4.1.min.js"></script>
<script src="layout/js/script.js"></script>
</head>
<body>
<div id="mainContent">
    