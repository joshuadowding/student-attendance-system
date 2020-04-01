<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home - Student Attendance System</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/templatemo-style.css">
</head>

<body>
    <?php include("includes/body-preloader-contents.php"); ?>
    <?php include("includes/body-menu-contents.php"); ?>

    <!-- HOME -->
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="row">

            <div class="owl-carousel owl-theme">
                <div class="item item-first">
                    <div class="caption">
                        <div class="container">
                            <div class="col-md-8 col-sm-12">
                                <h3>Student attendance system</h3>
                                <h1>Our mission is to provide an unforgettable experience</h1>
                                <a href="#roles" class="section-btn btn btn-default smoothScroll">view whole attendance_system</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item item-second">
                    <div class="caption">
                        <div class="container">
                            <div class="col-md-8 col-sm-12">
                                <h3>overall attendance system</h3>
                                <h1>The overall student attendance system to view all data </h1>
                                <a href="#team" class="section-btn btn btn-default smoothScroll">Discover things</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item item-third">
                    <div class="caption">
                        <div class="container">
                            <div class="col-md-8 col-sm-12">
                                <h3>student data</h3>
                                <h1>overall student attendance</h1>
                                <a href="#contact" class="section-btn btn btn-default smoothScroll">view attendance</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="about-info">
                        <div class="section-title wow fadeInUp" data-wow-delay="0.2s">
                            <h4>view manager side work</h4>
                            <h2>overall room capacity</h2>
                        </div>

                        <div class="wow fadeInUp" data-wow-delay="0.4s">
                            <?php if(!empty($_SESSION["currentUser"])) {
                                echo "<p>Test Session Result (logged-in as): <b>";
                                echo $_SESSION["currentUser"]->userFirstName;
                                echo " ";
                                echo $_SESSION["currentUser"]->userLastName;
                                echo " ";
                                echo $_SESSION["currentUser"]->userEmail;
                                echo " ";
                                echo $_SESSION["currentUser"]->userID;
                                echo " ";
                                echo $_SESSION["currentUser"]->userType;
                                echo "</b></p>";
                            }?>
                        </div>

                        <div class="wow fadeInUp" data-wow-delay="0.4s">
                            <p>Use this advance system application to manage student attendance and diiferent types of works and schemas to view it and change if required.</p>
                            <p>Today all know we are living between differnt types of applications so if u liked this system and u want to give any suggestions or any questions please feel free drop email or contact in following email_address and contact_number. mailto:info@company.com or 07436998828 <a href="https://plus.google.com/+templatemo"
                                    target="_parent">templatemo</a>. Thank you.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="wow fadeInUp about-image" data-wow-delay="0.6s">
                        <img src="images/about-image.jpg" class="img-responsive" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section id="team" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>meet our roles</h2>
                        <h4>They are nice &amp; friendly</h4>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <img src="images/team-image1.jpg" class="img-responsive" alt="">
                        <div class="team-hover">
                            <div class="team-item">
                                <h4> as we have diffrent roles to manage ech of the data</h4>
                                <ul class="social-icon">
                                    <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                    <li><a href="#" class="fa fa-envelope-o"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>New room</h3>
                        <p>available spaces</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <img src="images/team-image2.jpg" class="img-responsive" alt="">
                        <div class="team-hover">
                            <div class="team-item">
                                <h4>find out spaces or capacity in rooms</h4>
                                <ul class="social-icon">
                                    <li><a href="#" class="fa fa-instagram"></a></li>
                                    <li><a href="#" class="fa fa-flickr"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>group of developer</h3>
                        <p>Owner &amp; Manager</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.6s">
                        <img src="images/team-image3.jpg" class="img-responsive" alt="">
                        <div class="team-hover">
                            <div class="team-item">
                                <h4>main focus </h4>
                                <ul class="social-icon">
                                    <li><a href="#" class="fa fa-github"></a></li>
                                    <li><a href="#" class="fa fa-google"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3>administrator</h3>
                        <p>view and manage all stored data</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- MENU-->
    <section id="menu" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Our services</h2>
                        <h4>students &amp; attendance</h4>
                    </div>
                </div>
            </div>
     </section>

    <!-- CONTACT -->
    <section id="contact" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->
                <div class="wow fadeInUp col-md-6 col-sm-12" data-wow-delay="0.4s">
                    <div id="google-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3647.3030413476204!2d100.5641230193719!3d13.757206847615207!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf51ce6427b7918fc!2sG+Tower!5e0!3m2!1sen!2sth!4v1510722015945"
                            allowfullscreen></iframe>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">

                    <div class="col-md-12 col-sm-12">
                        <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                            <h2>Contact Us</h2>
                        </div>
                    </div>

                    <!-- CONTACT FORM -->
                    <form action="#" method="post" class="wow fadeInUp" id="contact-form" role="form"
                        data-wow-delay="0.8s">

                        <!-- IF MAIL SENT SUCCESSFUL  // connect this with custom JS -->
                        <h6 class="text-success">Your message has been sent successfully.</h6>

                        <!-- IF MAIL NOT SENT -->
                        <h6 class="text-danger">E-mail must be valid and message must be longer than 1 character.</h6>

                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" id="cf-name" name="name" placeholder="Full name">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <input type="email" class="form-control" id="cf-email" name="email"
                                placeholder="Email address">
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <input type="text" class="form-control" id="cf-subject" name="subject"
                                placeholder="Subject">

                            <textarea class="form-control" rows="6" id="cf-message" name="message"
                                placeholder="Tell about your project"></textarea>

                            <button type="submit" class="form-control" id="cf-submit" name="submit">Send
                                Message</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <?php include("includes/body-footer-contents.php"); ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
