<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student - Student Attendance System</title>

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

    <!-- 'As a student, I want to see a report on my overall attendance' Task #1 (Mani) -->
    <div class="container">
        <script>
            window.onload = function() {
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Your Attendance by Class"
                    },
                    subtitles: [{
                        text: "Specific Year"
                    }],
                    data: [{
                        type: "pie",
                        yValueFormatString: "#,##0.00",
                        indexLabel: "{label} {y}",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });

                chart.render();
            }
        </script>

        <?php if(isset($dataPoints)) : ?>
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <?php endif; ?>
    </div>

    <?php //include("includes/body-footer-contents.php"); ?>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>
