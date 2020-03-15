<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
    	include_once('application/models/Rooms.php');
        include_once('application/models/Student.php');
        include_once('application/models/Lesson.php');
        include_once('application/models/Attendance.php');

        include_once('application/models/view_models/ManagerViewModel.php'); // NOTE: View Model

        session_start(); // DEBUG: Start/Resume session.

        $viewModel = new ManagerViewModel();
        $_SESSION["sessionError"] = null;

        // NOTE: Catch unauthorised users before processing the request:
        if (!empty($_SESSION["currentUser"])) {
            if ($_SESSION["currentUser"]->userType != "Manager") {
                $this->load->helper('url');
                redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (home) page.
            } else {
                $this->load->database();
        }
        } else {
            $this->load->helper('url');
            redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (home) page.
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inputSearch = $_POST["input-search"];

            if (!empty($inputSearch)) {
                $_inputSearch = $this->validate($inputSearch);

                // TODO: Process input and display relevant output.
                $viewModel->rooms = $this->fetch_rooms($_inputSearch);

                   if (isset($viewModel->rooms)) {
                    foreach ($viewModel->rooms as $room) {
                        $students = array();

                        if (isset($room->capacity)) {
                            foreach ($room->capacity as $capacity) {
                                $_students = $this->fetch_students($capacity->studentID);

                              if (isset($_students)) {
                                    foreach ($_students as $student) {
                                        $students->attendance = $this->fetch_attendances($student->studentID);

                                     if (isset($student->attendances)) {
                                            array_push($students, $student);
                                        } else {
                                            $_SESSION["sessionError"] = "Unable to fetch attendances: no attendances present.";
                                        }
                                    }
                                 } else {
                                    $_SESSION["sessionError"] = "Unable to fetch students: no students present.";
                                }
                            }
                        } else {
                        	$_SESSION["sessionError"] = "Unable to fetch capacity: no capacity present.";
                        }

                        $capacity = new Capacity();
                        $capacity->usage = array();

                        // TODO: Organize rooms capacity.
                        foreach ($students as $student) {
                            $attendances = array();

                            for ($x = 0; $x < 10; $x++) { // NOTE: weeks.
                                $group = array();

                                 foreach ($student->attendances as $attendance) {
                                    $attendance->lesson = $this->fetch_lesson($attendance->classID, $x);
                                    array_push($group, $attendance);
                                }

                                array_push($attendances, $group);
                            }

                            array_push($rooms->usage, $attendances);
                        }

                        $room->capacity = $capacity;
                        $viewModel->students = $students;

                        if (!isset($room->capacity->usage)) {
                            $_SESSION["sessionError"] = "Unable to fetch capacity usage: no capacity usage present.";
                        }
                    }

                    $this->load->view('manager', $viewModel);
                } else {
                    $_SESSION["sessionError"] = "Unable to fetch rooms: no rooms present.";
                    $this->load->view('manager', $viewModel);
                }
                } else {
                $_SESSION["sessionError"] = "Please specify a room to search for.";
                $this->load->view('manager', $viewModel);
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->load->view('manager', $viewModel);
        }
    }

    public function save() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["attendance"])) {
                $checkList = $_POST["attendance"];

                foreach ($_POST["attendance"] as $selected) {
                    $_selected = $selected;
                }
            }

            $this->load->helper('url');
            redirect(base_url() . 'index.php/manager', 'location'); // DEBUG: Redirect back to the 'manager' page.
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->load->helper('url');
            redirect(base_url() . 'index.php/manager', 'location'); // DEBUG: Redirect back to the 'manager' page.
        }
    }

    public function fetch_rooms($inputSearch) {
        $rooms = array();

        try {
            $queryString = "SELECT * FROM `rooms` WHERE CONCAT(`RoomID`, `Name`) LIKE ?;";
            $_inputSearch = "%" . $inputSearch . "%";
            $queryResult = $this->db->query($queryString, array($_inputSearch));

             if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $roomModel = new Room();

                    $roomModel->roomID = $row->RoomID;
                    $roomModel->name = $row->Name;
                    $roomModel->location = $row->Location;
                    $roomModel->capacity = $row->Capacity;

                    $roomModel->capacity = $this->fetch_capacity($roomModel->roomID);

                    array_push($rooms, $roomModel);
                }
            } else {
                return null;
            }
            return $rooms;
    }

    public function fetch_capacity($roomID) {
        $capacity = array();

        try {
        	$queryString = "SELECT * FROM `modules.classes` WHERE `StudentID` = ?;";
            $queryResult = $this->db->query($queryString, array($studentID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $capacity = new capacity();

                    $capacity->roomID = $row->RoomID;
                    //$capacity->studentID = $row->StudentID; // NOTE: Not needed in this context.
                   
                   array_push($capacity, $capacity);
                }
            } else {
                return null;
            }
            } catch (PDOException $exception) {
            return null;
        }

        return $capacity;
    }

     public function fetch_students($studentID) {
        $students = array();

        try {
            $queryString = "SELECT * FROM `students` WHERE `studentID` = ?;";
            $queryResult = $this->db->query($queryString, array($studentID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $studentModel = new student();

                    $studentModel->studentID = $row->StudentID;
                    $studentModel->firstName = $row->FirstName;
                    $studentModel->lastName = $row->LastName;
                    $studentModel->email = $row->Email;
                    $studentModel->concern = $row->Concern;
                    $studentModel->type = $row->Type;
                    $studentModel->userID = $row->UserID;

                    array_push($students, $studentModel);
                }
            } else {
            	return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $students;
    }

    public function fetch_lessons($moduleID) {
        $lessons = array();

        try {
            $queryString = "SELECT * FROM `modules.classes` WHERE `ModuleID` = ?;";
            $queryResult = $this->db->query($queryString, array($moduleID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $lessonModel = new Lesson();

                    $lessonModel->classID = $row->ClassID;
                    $lessonModel->moduleID = $row->ModuleID;
                    $lessonModel->staffID = $row->StaffID;
                    $lessonModel->startDate = $row->StartDate;
                    $lessonModel->endDate = $row->EndDate;
                    $lessonModel->day = $row->Day;
                    $lessonModel->startTime = $row->StartTime;
                    $lessonModel->endTime = $row->EndTime;
                    $lessonModel->classType = $row->ClassType;

                    array_push($lessons, $lessonModel);
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }
     return $lessons;
    }

    public function fetch_attendance($classID, $week) {
        $attendanceModel = new Attendance();

        try {
            $queryString = "SELECT * FROM `attendance` WHERE `ClassID` = ? AND `Week` = ?;";
            $queryResult = $this->db->query($queryString, array($classID, $week));

            if ($queryResult->num_rows() != 0) {
                $row = $queryResult->row();

                if (isset($row)) {
                    $attendanceModel->attendanceID = $row->AttendanceID;
                    $attendanceModel->classID = $row->ClassID; // NOTE: Not needed in this context.
                    $attendanceModel->studentID = $row->StudentID; // NOTE: Not needed in this context.
                    $attendanceModel->attended = $row->Attended;
                    $attendanceModel->late = $row->Late;
                    $attendanceModel->week = $row->Week;
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $attendanceModel;
    }

      
    private function validate($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }












                     





















