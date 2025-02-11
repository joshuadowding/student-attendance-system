<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Student Attendance System</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/templatemo-style.css"> <!-- Custom CSS -->

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="js/smoothscroll.js"></script>

    <script type="text/javascript" src="js/custom.js"></script> <!-- Custom JavaScript -->
</head>

<body>
    <?php include("includes/body-preloader-contents.php"); ?>
    <?php //include("includes/body-menu-contents.php"); ?>

    <!-- LOGIN -->
    <div class="user-login-wrapper">
        <h1 class="user-login-header">Student Attendance System</h1>

        <!-- NOTE: Display login error (if any): -->
        <?php
            if (!empty($_SESSION["loginError"])) {
                echo "<div class='user-login-message'><p><b>";
                echo $_SESSION["loginError"];
                echo "</b></p></div>";
            } else if (!empty($_SESSION["internalError"])) {
                echo "<div class='user-login-message'><p><b>";
                echo $_SESSION["internalError"];
                echo "</b></p></div>";
            }
        ?>

        <form id="user-login" action="/student-attendance-system/index.php/login" method="POST">
            <label for="input-username">Username:</label>
            <input type="text" id="input-username" name="input-username" required="required" value="">

            <label for="input-password">Password:</label>
            <input type="password" id="input-password" name="input-password" required="required" value="">

            <input type="submit" name="submit" id="login-submit" value="Login">
        </form>
    </div>

    <?php //include("includes/body-footer-contents.php"); ?>
</body>

</html>
