<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manage - Student Attendance System</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <link rel="stylesheet" href="../css/templatemo-style.css">
</head>

<body>

    <?php include("includes/body-preloader-contents.php"); ?>
    <?php include("includes/body-menu-contents.php"); ?>

    <!-- ADMIN -->
    <div class="user-admin-wrapper">
        <?php
        if (isset($_SESSION["sessionError"])) {
            echo "<div class='alert alert-primary' role='alert'>";
            echo $_SESSION["sessionError"];
            echo "</div>";
        }

        
        ?>
    </div>

    <!--<?php include("includes/body-footer-contents.php"); ?>-->

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/smoothscroll.js"></script>
    <script src="../js/custom.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            
        });
    </script>

</body>

</html>