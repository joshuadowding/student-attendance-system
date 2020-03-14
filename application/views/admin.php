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
            if (isset($_SESSION["sessionError"])) {
                echo "<div class='alert alert-primary' role='alert'>";
                echo $_SESSION["sessionError"];
                echo "</div>";
            }
        ?>

        <form id="user-admin-search" method="POST" action="/student-attendance-system/index.php/admin">
            <label for="input-search">Search:</label>
            <input type="text" id="input-username" name="input-search" required="required" placeholder="Student's Name" value="">

            <input type="submit" name="submit" id="login-submit" value="Login">
        </form>

        <?php
            // TODO: Build a table of students, modules and classes. Fill table with attendance marks.
            if (isset($students)) {
                foreach ($students as $student) {
                    echo "<form class='timetable-wrapper' method='POST' action='/student-attendance-system/index.php/admin/save'>";
                    echo "<p>" . $student->firstName . " " . $student->lastName . "</p>";
                    echo "<input type='submit' name='submit' id='save-submit' value='Save'>";

                    if (isset($student->timetable->schedule)) {
                        foreach ($student->timetable->schedule as $schedule) {
                            echo "<div class='timetable-module'>";
                            echo "<table><caption>";

                            foreach ($modules as $module) { // TODO: I hate this solution.
                                for ($x = 0; $x < count($schedule); $x++) {
                                    for ($y = 0; $y < count($schedule[$x]); $y++) {
                                        if ($module->moduleID == $schedule[$x][$y]->moduleID) {
                                            echo $module->title;
                                            break 2;
                                        }
                                    }
                                }
                            }

                            echo "</caption><thead><tr>";

                            for ($x = 0; $x < count($schedule); $x++) {
                                echo "<th colspan='2'>Week" . ($x + 1) . "</th>";
                            }

                            echo "</tr><tr>";

                            for ($x = 0; $x < count($schedule); $x++) {
                                for ($y = 0; $y < count($schedule[$x]); $y++) {
                                    echo "<th colspan='1'>" . $schedule[$x][$y]->classType[0] . "</th>";
                                }
                            }

                            echo "</tr></tr></thead><tbody><tr>";

                            for ($x = 0; $x < count($schedule); $x++) {
                                for ($y = 0; $y < count($schedule[$x]); $y++) {
                                    $attendance = $schedule[$x][$y]->attendance;

                                    if (isset($attendance)) {
                                        if ($attendance->attended == "1" || $attendance->attended == 1) {
                                            echo "<td><input type='hidden' class='schedule_input' data-id=" . $attendance->attendanceID . " name='attendance[]' value='1'></input>";
                                            echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . " checked></input></td>";
                                        } else {
                                            echo "<td><input type='hidden' class='schedule_input' data-id=" . $attendance->attendanceID . " name='attendance[]' value='0'></input>";
                                            echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . "></input></td>";
                                        }
                                    } else {
                                        echo "<td><input type='hidden' class='schedule_input' name='attendance[]' data-id='-1' value='-1'></input>";
                                        echo "<input type='checkbox' class='schedule_checkbox' data-id='-1' disabled></input></td>";
                                    }
                                }
                            }

                            echo "</tr></tr></tbody></table></div>";
                        }

                        echo "</form>";
                    }
                }
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
            $(".schedule_checkbox").click(function() {
                if($(this).prop("checked") == true) {
                    var dataID = $(this).data("id");
                    $(".schedule_input[data-id=" + dataID + "]").val("1");
                }
                else if($(this).prop("checked") == false) {
                    var dataID = $(this).data("id");
                    $(".schedule_input[data-id=" + dataID + "]").val("0");
                }
            });
        });
    </script>

</body>

</html>