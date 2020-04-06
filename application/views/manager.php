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

    <?php
        if (isset($_SESSION["sessionError"])) {
            echo "<div class='alert alert-primary' role='alert'>";
            echo $_SESSION["sessionError"];
            echo "</div>";
        }
    ?>

<<<<<<< HEAD
    <!-- 'As a manager I want to know which lectures have been poorly attended' Task #5 (Josh) -->
    <div class="container" id="user-manager-wrapper">
        <?php
        if (isset($timetable)) {
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

                    echo "</div></div>";
                }

                echo "</div><div class='scroll-overlay overlay-right'></div></div>";
                echo "</div>";
            }
            ?>
        </div>
<<<<<<< HEAD
            echo "</div></div>";

        }
        ?>
    </div>

    
   
    <!-- 'As a manager I want to know room usage vs capacity' Task #4 (Janvi) -->

    <div class="container" id = "user-manager-wrapper">
       <body>          
                 
                 <h1 class="header"> Room's Usage or Capacity View</h1>

                 <form id = "user-manager-search" method = "POST" action = "/student-attendance-system/index.php/manager">
                 	<label for = "input-room">Room:</label>
                 	<input type ="text" class="form-control" id ="input-username" name ="input-search" required="required" placeholder ="Room's Capacity" value = "">
                 	<input type="submit" name="submit" class="btn btn-primary" id="login-submit" value="Search">

         
        </form>

    	<?php 
    	if (isset($capacity)){
    		foreach ($capacity as $capacity) {

                echo "<div class = 'capacity-wrapper' method ='POST' action = 'student-attendance-system/index.php/manager/save'>";
    	    	echo "<div class = 'capacity-header'> <h1 class = 'header'> Room Capacity </h1></div>";
    		    echo "<div class = 'list-group' id = 'list-tab' role = 'tablist'>";
                
                echo "<p>" . $room->RoomID . " " . $room->Name . "</p>";
                echo "<input type='submit' class='btn btn-primary' name='submit' id='save-submit' value='Save'></div>";

                echo "<div class='capacity-header' id='capacity-key'>";
                echo "<p><b>PCs</b> - PCs, <b>P</b> - Printer, <b>T</b> - Type</p>";
                echo "</div>";

                echo "<input type='hidden' class='room' name='room' value='" . $room->roomID . "'></input>";

    		
    		 
    	}
        
         foreach($capacity->group as $group){
         	$repeat = 0;

         	foreach($usage as $usage){
         		for($a = 0;$a<count($group);$a++){
         			for($c = 0;$c<count($group[$a]);$c++){

         				if($usage->roomID == $capacity [$a][$c]->roomID){
         					if($repeat == 0){
         						echo "<a class='list-group-item active' id='list-" . $repeat . "-list' data-target='#list-" . $repeat . "' role='tab'>" . $room->roomID . "</a>"; 
         					} else{
                                    echo "<a class='list-group-item' id='list-" . $repeat . "-list' data-target='#list-" . $repeat . "' role='tab'>" . $room->roomID  . "</a>";
         					}
         					break 2;
         				}
         			}
         		}
         	   $repeat = $repeat + 1;
         	}

         }


            echo "<div class='tab-content-wrapper'><div class='scroll-overlay overlay-left'></div>";
            echo "<div class = 'tab-content' id = 'nav-tab-content'>";
              for($d = 0;$d < count($capacity->usage);$d++){
              	$usage = $capacity->usage[$d];

              	if($d == 0){
              		echo "<div class='tab-pane active' id='list-" . $d . "' role='tabpanel'>";
                    } else {
              	} 
              	echo "<div class = 'tab-pane' id = 'list-" . $d ."' role= 'tabpanel'>";
              }

                echo "<div class = 'tab-list'>";

                for($a = 0;$a < count($usage);$a++){
                	echo "<div class = 'capacity-item'>";
                	echo "<div class = 'item-header'><span class = 'header'>Week" .($a + 1). "</span></div>";
                	echo "<div class = 'tab-list'>";
                }

                for($a = 0;$a < count($usage);$a++){
                	echo "<div class = 'capacity-item'>";

                	echo "<div class = 'item-header'><span class = 'header'> Week" .($a + 1). "</span></div>";

                	echo "<div class = 'item-content'>";

                	for($c = 0;$c < count($usage[$a]);$c++){
                		echo "<div class = 'content'>";
                		echo "<table class = 'room'>";

                		if($c == 0){
                			echo "<tr><th></th><th>PCs</th><th>Printer</th></tr>";
                		}
                		echo "<tr><td class = 'type'>" . $usage[$a][$c]->Type ."</td>";

                		$capacity = $usage[$a][$c]->capacity;

                		if(isset($capacity)){
                			//$name = 0;
                			//$location = 0;
                			$capacity = 0;
                			$pcs = 0;
                			$printer = 0;
                			$type = 0;

                			foreach($capacity as $record){
                				if($record->capacity == "1" || $record->capacity == 1){
                				}
                				$capacity = $capacity + 1;
                			}
                		}
                		echo "<td>".$capacity."</td>";
                	} 
                	echo "</table></div>";
                }
                echo "</div></div>";
          
           echo "</div></div>";
       
       echo "</div></div>";
   
                echo "</div><div class='scroll-overlay overlay-right'></div></div>";
                echo "</div>";
            
?>
</div>



       
<<<<<<< HEAD

           <div class = "container" id="user-manager-wrapper">
           	
           		<h1 class= "header">Student Attendance Record</h1>

           		<form id="user-manager-wrapper" method="POST" action ="student-attendance-system/index.php/manager">
           			<label for="input-student">Student:</label>
           			<input type="text" class="form-control" id="input-username" name="input-search" required="required" placeholder="Student's Attendance" value="">
           			<input type="submit" name="submit" class="btn btn-primary" id="login-submit" value="search">
           		</form>

             <?php
                $student = 20;

                // Evaluates to true because $student is empty.
                // TODO: notify me when students have less attendance in any module.


                if(isset($students)){
                	foreach($students as $student){


                		echo "<form class= 'record-wrapper' method = 'POST' action ='student-attendance-system/index.php/manager/save'>";

                		echo "<div class = 'record-header'><h1 class ='header'>Student's Attendance</h1></div>";
                		echo "<p>". $student->attendanceID . " " . $student->studentID . "</p>";
                		echo "<input type ='submit' class ='btn btn-primary' name='submit' id ='save-submit' value ='Save'></div>";

                		echo "<div class = 'record-header' id = 'record-key'>";
                		echo "<p><b>L</b> -Lecture, <b>P</b> -Practical </p>";
                		echo "</div>";

                		echo "<input type ='hidden' class ='student' name = 'student' value = '". $student->studentID ."'></input>";


                   	}
                }
              
              foreach($record->attendance as $attendance){
              	$trace = 0;

              	foreach($students as $student){
              		for($b = 0;$b<count($attendance);$b++){
              			for($e = 0;$e<count($attendance[$b]);$e++){

              				if($student->studentID == $attendance[$b][$e]->studentID){
              					if($trace == 0){
              						print "<a class='list-group-item active' id ='list-" . $trace ." -list' data-target='#list-" . $trace ." ' role-'tab'>". $student->StudentID. "</a>";
              					}
              					break 2;
              				}
              			}
              		}
              		$trace = $trace + 1;
              	}
              }
                
              echo "<div class = 'tab-content-wrapper'><div class = 'scroll-overlay-left'></div></div>";
              echo "<div class = 'tab-content' id = 'nav-tab-content'> </div>";

              for ($f = 0;$f<count($record->attendance);$f++){
              	$attendance = $record->attendance[$f];

              	if($f == 0){
              		echo "<div class = 'tab-pane active 'id = 'list-" .$f." 'role='tabpanel'>";
              	}else{
              		echo "<div class = 'tab-pane' id = 'list-" . $f . " ' role- 'tabpanel'>";
              	}
              	 echo "<div class = 'tab-list'>";
              	 for($b = 0;$b<count($attendance);$b++){
              	 	echo "<div class = 'record-item'>";
              	 	echo "<div class = 'item-header'><span class = 'header'>Week" . ($b + 1)."</span></div>";
              	 	
              	 	echo "<div class = 'tab-list'>";

              	 }
              	 for ($b = 0;$b<count($attendance);$b++){
              	 	echo "<div class = 'record-item'>";

              	 	echo "<div class ='item-header'><span class = 'header'>Week" .($b + 1). "</span></div>";
              	 	echo "<div class = 'item-content'>";

              	 	echo "<table class = 'schedule'>";

              	 	if ($b == 0){
              	 		echo "<tr><th></th><th>P</th><th>L</th></tr>";
              	 	}
              	 	    echo "<tr><td class = 'type'>" .$attendance[$b][$e]->classType. "</td>";

              	 	    $record = $attendance[$b][$e]->record;
              	 	    $students =$attendance[$b][$e]->students;

                      //Evaluates to true because $student is empty.

                      // if(empty($student = "")
                       	 //echo '$student is either 0, or not to set all ';
                       
                           
                           // Evaluates as true as $student is set
              	 	    if(isset($student)){
              	 	    	$attended = 0;
              	 	    	$late = 0;

              	 	    	foreach($student as $record){

              	 	    		if($record->attended == "1" || $record->attended == 1){

              	 	    			$attended = $attended + 1;

              	 	    			if($record->late == "1" || $record->late == 1){

              	 	    				$late = $late + 1;
              	 	    			}
              	 	    		}
              	 	    		   $percent = (40/100);
              	 	    		   $total = count($students);
              	 	    		   $threshold = ($total * $percent);

              	 	    		   if($attended >= $threshold){
              	 	    		   	echo "<td>" .$attended."</td>";
              	 	    		   } else {
              	 	    		   	if($late > 0){
              	 	    		   		echo "<td class = 'concern'>" .$attended . "</td>";
              	 	    		   	}else {
              	 	    		   		echo "<td>" .$late ."</td>";
              	 	    		   	}
              	 	    		   }
              	 	    		   if(isset($students)){
              	 	    		   	echo "<td>" . count($students) ."</td>";
              	 	    		   }else {
              	 	    		   	echo "<td></td>";
              	 	    		   }
              	 	    		   echo "<div class = 'scroll-overlay overlay-right'></div>";
              	 	    		   echo "</div>";

        ?>
    </div>        

    <?php include("includes/body-footer-contents.php"); ?>

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