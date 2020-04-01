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

        <form class="user-admin-search" method="POST" action="/student-attendance-system/index.php/admin">
            <label for="input-search">Search:</label>
            <input type="text" class="form-control" id="input-username" name="input-search" required="required" placeholder="Student's Name" value="">

            <input type="submit" name="submit" class="btn btn-primary" id="login-submit" value="Search">
        </form>

        <?php
        if (isset($students)) {
            foreach ($students as $student) {
                echo "<form class='timetable-wrapper' method='POST' action='/student-attendance-system/index.php/admin/save'>";

                echo "<div class='timetable-header'>";
                echo "<p>" . $student->firstName . " " . $student->lastName . "</p>";
                echo "<input type='submit' class='btn btn-primary' name='submit' id='save-submit' value='Save'></div>";

                echo "<div class='timetable-header' id='timetable-key'>";
                echo "<p><b>L</b> - Lecture, <b>P</b> - Practical, <b>S</b> - Seminar</p>";
                echo "</div>";

                echo "<input type='hidden' class='student' name='student' value='" . $student->studentID . "'></input>";

                if (isset($student->timetable->schedule)) {
                    $nullID = 1; // NOTE: If an attendance record doesn't exist for a given class, assign a "dummy" ID.

                    foreach ($student->timetable->schedule as $schedule) {
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
                                            echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id=" . $attendance->attendanceID . " data-class=" . $attendance->classID . " value='[" . $attendance->attendanceID . ", " . $attendance->classID . ", .5]'></input>";
                                            echo "<input type='hidden' class='schedule_toggle' data-id=" . $attendance->attendanceID . " value='1'></input>";
                                            echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . "></input></td>";
                                        } else {
                                            echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id=" . $attendance->attendanceID . " data-class=" . $attendance->classID . " value='[" . $attendance->attendanceID . ", " . $attendance->classID . ", 1]'></input>";
                                            echo "<input type='hidden' class='schedule_toggle' data-id=" . $attendance->attendanceID . " value='2'></input>";
                                            echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . " checked></input></td>";
                                        }
                                    } else {
                                        echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id=" . $attendance->attendanceID . " data-class=" . $attendance->classID . " value='[" . $attendance->attendanceID . ", " . $attendance->classID . ", 0]'></input>";
                                        echo "<input type='hidden' class='schedule_toggle' data-id=" . $attendance->attendanceID . " value='0'></input>";
                                        echo "<input type='checkbox' class='schedule_checkbox' data-id=" . $attendance->attendanceID . "></input></td>";
                                    }
                                } else {
                                    echo "<td colspan='" . $colspan . "'><input type='hidden' class='schedule_input' name='attendance[]' data-id='-" . $nullID . "' value='[-" . $nullID . ", -" . $nullID . ", 0]'></input>";
                                    echo "<input type='hidden' class='schedule_toggle' data-id='-" . $nullID . "' value='0'></input>";
                                    echo "<input type='checkbox' class='schedule_checkbox' data-id='-" . $nullID . "' disabled></input></td>";

                                    $nullID = $nullID + 1;
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

    <?php //include("includes/body-footer-contents.php"); ?>

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
            $(".schedule_input").each(function(index) {
                var value = $(this).val().replace("[", "").replace("]", "").split(",");

                for (i = 0; i < value.length; i++) {
                    var _value = value[i].trim();
                    if (_value == ".5") {
                        var dataID = $(this).data("id");
                        $(".schedule_checkbox[data-id=" + dataID + "]").prop("indeterminate", true);
                    }
                }
            });

            $(".schedule_checkbox").click(function() {
                var dataID = $(this).data("id");
                var classID = $(this).data("class");
                var toggleVal = $(".schedule_toggle[data-id=" + dataID + "]").val();

                if (toggleVal == 1) {
                    $(this).prop("indeterminate", false);
                    $(this).prop("checked", false);
                    $(".schedule_toggle[data-id=" + dataID + "]").val(0);
                    $(".schedule_input[data-id=" + dataID + "]").val("[" + dataID + ", " + classID + ", 0]");
                } else if ($(this).prop("checked") == false) {
                    if (toggleVal == 2) {
                        $(this).prop("indeterminate", true);
                        $(".schedule_toggle[data-id=" + dataID + "]").val(1);
                        $(".schedule_input[data-id=" + dataID + "]").val("[" + dataID + ", " + classID + ", .5]");
                    } else if (toggleVal == 1) {
                        $(this).prop("indeterminate", false);
                        $(".schedule_toggle[data-id=" + dataID + "]").val(0);
                        $(".schedule_input[data-id=" + dataID + "]").val("[" + dataID + ", " + classID + ", 0]");
                    }
                } else if ($(this).prop("checked") == true) {
                    var dataID = $(this).data("id");
                    $(".schedule_input[data-id=" + dataID + "]").val("[" + dataID + ", " + classID + ", 1]");
                    $(".schedule_toggle[data-id=" + dataID + "]").val(2);
                }
            });
        });
    </script>
</body>

</html>
