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

    <!-- MANAGER -->
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

            for ($z = 0; $z < count($timetable->schedule); $z++) {
                $schedule = $timetable->schedule[$z];

                if ($z == 0) {
                    echo "<div class='tab-pane active' id='list-" . $z . "' role='tabpanel'>";
                } else {
                    echo "<div class='tab-pane' id='list-" . $z . "' role='tabpanel'>";
                }

                echo "<div class='tab-list'>";
                for ($x = 0; $x < count($schedule); $x++) {
                    echo "<div class='timetable-item'>";
                    echo "<div class='item-header'><span class='header'>Week " . ($x + 1) . "</span></div>";

                    echo "<div class='item-content'>";

                    for ($y = 0; $y < count($schedule[$x]); $y++) {
                        echo "<div class='content'>";
                        echo "<table class='lesson'>";

                        if ($y == 0) {
                            echo "<tr><th></th><th>P</th><th>L</th><th>T</th></tr>";
                        }

                        echo "<tr><td class='type'>" . $schedule[$x][$y]->classType . "</td>";

                        $attendance = $schedule[$x][$y]->attendance;
                        $enrolments = $schedule[$x][$y]->enrolments;

                        if (isset($attendance)) {
                            $attended = 0;
                            $late = 0;

                            foreach ($attendance as $record) {
                                if ($record->attended == "1" || $record->attended == 1) {
                                    if ($record->late == "1" || $record->late == 1) {
                                        $late = $late + 1;
                                    }

                                    $attended = $attended + 1;
                                }
                            }

                            echo "<td>" . $attended . "</td>";
                            echo "<td>" . $late . "</td>";
                        } else {
                            echo "<td>X</td>";
                            echo "<td>X</td>";
                        }

                        if (isset($enrolments)) {
                            echo "<td>" . count($enrolments) . "</td>";
                        } else {
                            echo "<td>X</td>";
                        }

                        echo "</table></div>";
                    }

                    echo "</div></div>";
                }

                echo "</div></div>";
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

    <script type="text/javascript">
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
