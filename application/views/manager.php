<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager - Student Attendance System</title>

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

    <link rel="stylesheet" href="../css/templatemo-style.css"> <!-- Custom CSS -->

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="../js/wow.min.js"></script>
    <script type="text/javascript" src="../js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="../js/smoothscroll.js"></script>

    <script type="text/javascript" src="../js/custom.js"></script> <!-- Custom JavaScript -->
</head>

<body>
    <?php include("includes/body-preloader-contents.php"); ?>
    <?php include("includes/body-menu-contents.php"); ?>

    <?php if (isset($_SESSION["sessionError"])) {
        echo "<div class='alert alert-primary' role='alert'>";
        echo $_SESSION["sessionError"];
        echo "</div>";
    }?>

    <!-- 'As a manager I want to know which lectures have been poorly attended' Task #5 (Josh) -->
    <div class="container" id="user-manager-wrapper">
        <?php if (isset($timetable)) {
            echo "<div class='timetable-wrapper'>";
            echo "<div class='timetable-header'><h1 class='header'>Overall Module Attendance</h1></div>";
            echo "<div class='list-group' id='list-tab' role='tablist'>";

            foreach ($timetable->schedule as $schedule) {
                $iterate = 0;

                foreach ($modules as $module) { // TODO: I hate this solution.
                    for ($x = 0; $x < count($schedule); $x++) {
                        for ($y = 0; $y < count($schedule[$x]); $y++) {
                            if ($module->moduleID == $schedule[$x][$y]->moduleID) {
                                if ($iterate == 0) {
                                    echo "<a class='list-group-item active' id='list-" . $iterate . "-list' data-target='#list-" . $iterate . "' role='tab'>" . $module->title . "</a>";
                                } else {
                                    echo "<a class='list-group-item' id='list-" . $iterate . "-list' data-target='#list-" . $iterate . "' role='tab'>" . $module->title . "</a>";
                                }
                                break 2;
                            }
                        }
                    }

                    $iterate = $iterate + 1;
                }
            }

            echo "</div><div class='tab-content-wrapper'><div class='scroll-overlay overlay-left'></div>";
            echo "<div class='tab-content' id='nav-tab-content'>";

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
                            echo "<tr><th></th><th>A</th><th>L</th><th>T</th></tr>";
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

                            $percent = (70 / 100);
                            $total = count($enrolments);
                            $threshold = ($total * $percent);

                            if ($attended >= $threshold) {
                                echo "<td>" . $attended . "</td>";
                            } else {
                                echo "<td class='concern'>" . $attended . "</td>";
                            }

                            if ($late > 0) {
                                echo "<td class='late'>" . $late . "</td>";
                            } else {
                                echo "<td>" . $late . "</td>";
                            }
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

                echo "</div><div class='scroll-overlay overlay-right'></div></div>";
            }

            echo "</div></div></div>";
        }?>
    </div>

    <!--'As a Manager I want to be alerted when a student has attendance below certain thresholds.' Task #3 (Janvi) -->
    <div class="container" id="threshold-manager-wrapper">
        <h1 class="header">Student's Bad Attendance</h1>

        <form id="user-manager-search" class="form-inline" method="POST" action="/student-attendance-system/index.php/manager">
            <div class="form-group">
                <label for="input-number">Change a bad attendance threshold:</label>
                <div class="input-group">
                    <?php $threshold = is_numeric($threshold) ? $threshold : 20; ?>
                    <input type="text" class="form-control" name="input-search" required="required" placeholder="<?php echo $threshold; ?>" value="<?php echo $threshold; ?>">
                    <div class="input-group-addon">%</div>
                </div>
            </div>

            <input type="submit" name="submit" class="btn btn-primary" id="login-submit" value="Update">
        </form>

        <?php if (is_array($badAttendees)) : ?>
            <?php foreach ($badAttendees as $badAttendance) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Attention bad attendee!</strong> Student <?php echo $badAttendance->studentName; ?> with ID= <?php echo $badAttendance->studentID; ?> has attendance of <?php echo ceil($badAttendance->attendance); ?> % for class with ID = <?php echo $badAttendance->classID; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- 'As a manager I want to know room usage vs capacity' Task #4 (Janvi) -->
    <div class="container" id="usage-manager-wrapper">
        <h1 class="header">Room's Usage or Capacity View</h1>

        <form id="user-manager-search" method="POST" action="/student-attendance-system/index.php/manager">
            <label for="input-room">Search To View Room's Details:</label>
            <input type="text" class="form-control" name="input-search" required="required" placeholder="Room's ID">
            <input type="submit" name="submit" class="btn btn-primary" id="login-submit" value="Search">
        </form>

        <table style="width:100%">
            <tr>
                <th class="text-center">RoomID</th>
                <th class="text-center">Name</th>
                <th class="text-center">Location</th>
                <th class="text-center">Capacity</th>
                <th class="text-center">PCs</th>
                <th class="text-center">Printer</th>
                <th class="text-center">Type</th>
            </tr>

            <?php if (isset($room)) : ?>
                <tr>
                    <td class="text-center"><?php echo $room->roomID; ?></td>
                    <td class="text-center"><?php echo $room->name; ?></td>
                    <td class="text-center"><?php echo $room->location; ?></td>
                    <td class="text-center"><?php echo $room->capacity; ?></td>
                    <td class="text-center"><?php echo $room->pcs; ?></td>
                    <td class="text-center"><?php echo $room->printer; ?></td>
                    <td class="text-center"><?php echo $room->type; ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <?php //include("includes/body-footer-contents.php"); ?>

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
