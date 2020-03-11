<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin - Student Attendance System</title>

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
            // TODO: Build a table of students, modules and classes. Fill table with attendance marks.

            foreach ($modules as $module) {
                echo "<div class='timetable-module'>";
                echo "<table><caption>" . $module->title . "</caption>";
                echo "<thead><tr><th></th>";

                for ($x = 1; $x <= 12; $x++) {
                    echo "<th colspan='2'>Week " . $x . "</th>";
                }

                echo "</tr><tr><th></th>";

                for ($x = 1; $x <= 12; $x++) {
                    foreach ($module->lessons as $lesson) {
                        echo "<th colspan='1'>" . $lesson->classType . "</th>";
                    }
                }

                echo "</tr></thead><tbody>";

                foreach ($module->students as $student) {
                    echo "<tr><td>";
                    echo $student->firstName . " " . $student->lastName;
                    echo "</tr></td>";
                }

                echo "</tbody></table></div>";
            }
        ?>
    </div>

    <?php include("includes/body-footer-contents.php"); ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.stellar.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/smoothscroll.js"></script>
    <script src="../js/custom.js"></script>

</body>

</html>