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
           if (isset($_SESSION["sessionError"])) {
                echo "<div class='alert alert-primary' role='alert'>";
                echo $_SESSION["sessionError"];
                echo "</div>";
            }
        ?>

        <form id="user-manager-search" method="POST" action="/student-attendance-system/index.php/admin">
            <label for="input-roomid">RoomID:</label>
            <input type="text" id="input-roomid" name="input-roomid" required="required" value="">

            <label for="input-student_attendance">Student_attendance:</label>
            <input type="password" id="input-student_attendance" name="input-student-attendance" required="required" value="">

            <input type="search" name="search" id="data_search" value="data_search">
        </form>
    </div>

     <?php
            $student = 20;

     // 1st method of empty() and isset() function.       

            //Evaluates to true because $var is empty. 
            // TODO: notify me when students have less attendance in any module.

            if (empty($student)) {
            	foreach ($students as $student) {
            		echo "<form class='timetable-wrapper' method='POST' action='/student-attendance-system/index.php/admin/save'>";
                    echo "<'$student is either 20, empty, or not set at all'>";
                }

            //Evaluates as true because $student is set.
            
            if (isset($student)){
            	echo ("$student is set even though it is empty");
            } 
     ?>

<?php
       //another example of isset function method.
       class student
       {

       	  protected $_students = array();
       	  public function __set($attendance,$student_attendance)
       	  {
       	  	$this->_students[$attendance] = $student_attendance;
       	  }
           
           public function __get($attendance)
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

           	  public function __isset($attendance)
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


            






















