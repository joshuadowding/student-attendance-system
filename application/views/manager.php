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

    <link rel="stylesheet" href="../css/templatemo-style.css">
</head>

<body>

    <?php include("includes/body-preloader-contents.php"); ?>
    <?php include("includes/body-menu-contents.php"); ?>

    

    <!-- MANAGER -->
    <div class="user-manager-wrapper">
        <?php

              //Start the session
              session_start();

           if (isset($_SESSION["sessionError"])) {
                echo "<div class='alert alert-primary' role='alert'>";
                echo $_SESSION["sessionError"];
                echo "</div>";
            }

        ?>

   

        <form id="user-manager-search" method="POST" action="/student-attendance-system/index.php/manager">
            <label for="input-room">Room</label>
            <input type="text" class="form-control" id="input-username" name="input-search" required="required" placeholder="Room's Capacity" value="">

            <input type="submit" name="submit" class="btn btn-primary" id="login-submit" value="Search">
        </form>
    </div>

     
    <?php
         

        if (isset($rooms)) {
            foreach ($rooms as $room) {
                echo "<form class='manager_room-wrapper' method='POST' action='/student-attendance-system/index.php/manager/save'>";

                echo "<div class='manager_room-header'>";
                echo "<p>" . $room->RoomID . " " . $room->Name . "</p>";
                echo "<input type='submit' class='btn btn-primary' name='submit' id='save-submit' value='Save'></div>";

                 echo "<div class='manager_room-header' id='manager_room-key'>";
                echo "<p><b>L</b> - Lecture, <b>P</b> - Practical, <b>S</b> - Seminar</p>";
                echo "</div>";

                echo "<input type='hidden' class='room' name='room' value='" . $room->roomID . "'></input>";
            }
          }
        
        ?>
    </div>
    <div id ="dp"></div>

    <script type = "text/javascript">

      

   
   


     <?php
            $student = 20;
            if (isset($students)) {
            foreach ($students as $student) {
                echo "<form class='manager-wrapper' method='POST' action='/student-attendance-system/index.php/manager/save'>";

                echo "<div class='manager-header'>";
                echo "<p>" . $student->firstName . " " . $student->lastName . "</p>";
                echo "<input type='submit' class='btn btn-primary' name='submit' id='save-submit' value='Save'></div>";

                echo "<div class='manager-header' id='manager-key'>";
                echo "<p><b>L</b> - Lecture, <b>P</b> - Practical, <b>S</b> - Seminar</p>";
                echo "</div>";

                echo "<input type='hidden' class='student' name='student' value='" . $student->studentID . "'></input>";
   

            //Evaluates to true because $student is empty. 
            // TODO: notify me when students have less attendance in any module.



              
            
<?php
       //another example of isset function method.
       class student
       {

       	 $_students = array();

       	 function __set($attendance,$student_attendance)
       	  {
       	  	$this->_students[$attendance] = $student_attendance;
       	  }
           
              function __get($attendance)
           {
           	  if (isset($this->_students[$attendance]))
           	  	echo("student has less than 20 percent attendance in particular module");

           	  {
           	  	return($this->_students[$attendance]); 
           	  	echo("student has 40 percent attendance in module");         	
           	  	  }else{
           	  	  	return null;
           	  	  }
           	  }

           	       function __isset($attendance)
           	  {
           	  	if (isset($this->_students[$attendance])) {
           	  		   return(false === empty($this->_students[$attendance]));
           	  		}else {
           	  			return null;
           	  		
           	  		}
           	  }
           }
       } 

?>                 
                    
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
        
    </script

</body>

</html>


            






















