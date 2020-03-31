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
    <div class="container user-manager-wrapper">
        <?php
        if (isset($_SESSION["sessionError"])) {
            echo "<div class='alert alert-primary' role='alert'>";
            echo $_SESSION["sessionError"];
            echo "</div>";
        }

        if (isset($timetable)) {
            echo "<div class='timetable-wrapper'>";
            echo "<div class='timetable-header'></div>";

            echo "<div class='list-group' id='list-tab' role='tablist'>";

            foreach ($timetable->schedule as $schedule) {
                $iterate = 0;

                foreach ($modules as $module) { // TODO: I hate this solution.
                    for ($x = 0; $x < count($schedule); $x++) {
                        for ($y = 0; $y < count($schedule[$x]); $y++) {
                            if ($module->moduleID == $schedule[$x][$y]->moduleID) {
                                if ($iterate == 0) {
                                    echo "<a class='list-group-item active' id='list-" . $iterate . "-list' data-target='#list-" . $iterate ."' role='tab'>" . $module->title ."</a>";
                                } else {
                                    echo "<a class='list-group-item' id='list-" . $iterate . "-list' data-target='#list-" . $iterate . "' role='tab'>" . $module->title ."</a>";
                                }
                                break 2;
                            }
                        }
                    }

                    $iterate = $iterate + 1;
                }
            }

            echo "</div><div class='tab-content' id='nav-tab-content'>";

            $iterate = 0;
            foreach ($timetable->schedule as $schedule) {
                if ($iterate == 0) {
                    echo "<div class='tab-pane active' id='list-" . $iterate . "' role='tabpanel'>";
                } else {
                    echo "<div class='tab-pane' id='list-" . $iterate . "' role='tabpanel'>";
                }

                echo "<div class='timetable-module'>";
                echo "<table class='table'><thead><tr>";

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

                echo "</tr></thead><tbody><tr>";

                for ($x = 0; $x < count($schedule); $x++) {
                    for ($y = 0; $y < count($schedule[$x]); $y++) {
                        $attendance = $schedule[$x][$y]->attendance;
                        $enrolments = $schedule[$x][$y]->enrolments;

                        $colspan = null; // NOTE: Assumes that there'll only ever be a maximum of two lessons per week.

                        if (count($schedule[$x]) > 1) {
                            $colspan = 1;
                        } else if (count($schedule[$x]) <= 1) {
                            $colspan = 2;
                        }


                        if (isset($attendance)) {
                            $attended = 0;
                            $late = 0;

                            // TODO: Iterate through attendance array, check attendance and late flags...
                            foreach ($attendance as $record) {
                                if ($record->attended == "1" || $record->attended == 1) {
                                    if ($record->late == "1" || $record->late == 1) {
                                        $late = $late + 1;
                                    }

                                    $attended = $attended + 1;
                                }
                            }

                            echo "<td colspan='" . $colspan . "'>" . $attended . " (" . $late . ")";
                        } else {
                            echo "<td colspan='" . $colspan . "'> No Data";
                        }

                        if (isset($enrolments)) {
                            echo "/" . count($enrolments) . "</td>";
                        }
                    }
                }

                $iterate = $iterate + 1;
                echo "</tr></tbody></table></div></div>";
            }

            echo "</div></div>";
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

    <script>
        $(document).ready(function() {
            $(".list-group .list-group-item").click(function() {
                var target = $(this).data("target");

                $(".tab-content .tab-pane").each(function() {
                    $(this).removeClass("active");
                });

                $(".list-group .list-group-item").each(function() {
                    $(this).removeClass("active");
                });

                $(target).addClass("active");
                $(this).addClass("active");
            });
        });
    </script>

</body>

</html>
