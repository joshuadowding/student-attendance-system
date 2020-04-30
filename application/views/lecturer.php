<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lecturer - Student Attendance System</title>

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

    <!-- 'As a lecturer I want to know attendance by module' Task #8 (Trinath, Mani) -->
    <div class="container">
        <script>
            window.onload = function() {
                var moduleChart = new CanvasJS.Chart("moduleChartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Attendance By Module"
                    },
                    subtitles: [{
                        text: "Specific Year"
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00",
                        indexLabel: "{label} {y}",
                        dataPoints: <?php echo json_encode($moduleAttendance, JSON_NUMERIC_CHECK); ?>
                    }]
                });

                moduleChart.render();
            }
        </script>

        <?php if(isset($moduleAttendance)) : ?>
            <div id="moduleChartContainer" style="height: 370px; width: 100%;"></div>
        <?php endif; ?>
    </div>

    <!-- 'As a lecturer I want to know an individual student’s attendance' Task #6 (Trinath) -->
    <div class="container">
        <!-- TODO -->
    </div>

    <!-- 'As a lecturer I want to know attendance by class' Task #7 (Mani) -->
    <div class="container">
        <script>
            window.onload = function() {
                var classChart = new CanvasJS.Chart("classChartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Attendance By Class"
                    },
                    subtitles: [{
                        text: "Specific Year"
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00",
                        indexLabel: "{label} {y}",
                        dataPoints: <?php echo json_encode($classAttendance, JSON_NUMERIC_CHECK); ?>
                    }]
                });

                classChart.render();
            }
        </script>

        <?php if(isset($classAttendance)) : ?>
            <div id="classChartContainer" style="height: 370px; width: 100%;"></div>
        <?php endif; ?>
    </div>

    <?php //include("includes/body-footer-contents.php"); ?>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>
