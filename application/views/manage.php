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

        if (isset($timetable)) {
            echo "<div class='timetable-wrapper'>";
            echo "<div class='timetable-header'></div>";

            foreach ($timetable->schedule as $schedule) {
                echo "<div class='timetable-module'>";
                echo "<table class='table'><caption>";

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
                    echo "<th scope='col' colspan='2'>Week " . ($x + 1) . "</th>";
                }

                echo "</tr><tr>";

                for ($x = 0; $x < count($schedule); $x++) {
                    for ($y = 0; $y < count($schedule[$x]); $y++) {
                        $colspan = null; // NOTE: Assumes that there'll only ever be a maximum of two lessons per week.
                        if (count($schedule[$x]) > 1) {
                            $colspan = 1;
                        } else if (count($schedule[$x]) <= 1) {
                            $colspan = 2;
                        }

                        echo "<th scope='col' colspan='" . $colspan . "'>" . $schedule[$x][$y]->classType[0] . "</th>";
                    }
                }

                echo "</tr></tr></thead><tbody><tr>";

                for ($x = 0; $x < count($schedule); $x++) {
                    for ($y = 0; $y < count($schedule[$x]); $y++) {
                        $attendance = $schedule[$x][$y]->attendance;
                        $colspan = null; // NOTE: Assumes that there'll only ever be a maximum of two lessons per week.

                        if (count($schedule[$x]) > 1) {
                            $colspan = 1;
                        } else if (count($schedule[$x]) <= 1) {
                            $colspan = 2;
                        }

                        if (isset($attendance->attendanceID)) {
                            if ($attendance->attended == "1" || $attendance->attended == 1) {
                                if ($attendance->late == "1" || $attendance->late == 1) {
                                    //echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id=" . $attendance->attendanceID . " data-class=" . $attendance->classID . " value='[" . $attendance->attendanceID . ", " . $attendance->classID . ", .5]'></input>";
                                    //echo "<input type='hidden' class='schedule_toggle' data-id=" . $attendance->attendanceID . " value='1'></input>";
                                    //echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . "></input></td>";
                                } else {
                                    //echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id=" . $attendance->attendanceID . " data-class=" . $attendance->classID . " value='[" . $attendance->attendanceID . ", " . $attendance->classID . ", 1]'></input>";
                                    //echo "<input type='hidden' class='schedule_toggle' data-id=" . $attendance->attendanceID . " value='2'></input>";
                                    //echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . " checked></input></td>";
                                }
                            } else {
                                //echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id=" . $attendance->attendanceID . " data-class=" . $attendance->classID . " value='[" . $attendance->attendanceID . ", " . $attendance->classID . ", 0]'></input>";
                                //echo "<input type='hidden' class='schedule_toggle' data-id=" . $attendance->attendanceID . " value='0'></input>";
                                //echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . "></input></td>";
                            }
                        } else {
                            //echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id='-" . $nullID . "' value='[-" . $nullID . ", -" . $nullID . ", 0]'></input>";
                            //echo "<input type='hidden' class='schedule_toggle' data-id='-" . $nullID . "' value='0'></input>";
                            //echo "<input type='checkbox' class='schedule_checkbox' data-id='-" . $nullID . "' disabled></input></td>";

                            //$nullID = $nullID + 1;
                        }
                    }
                }

                echo "</tr></tr></tbody></table></div>";
            }

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
