<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller {

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
        include_once('application/models/User.php');
        include_once('application/models/Student.php');
        include_once('application/models/Module.php');
        include_once('application/models/Enrolment.php');
        include_once('application/models/Lesson.php');
        include_once('application/models/Attendance.php');
        include_once('application/models/Timetable.php');

        include_once('application/models/view_models/AdminViewModel.php'); // NOTE: View Model

        session_start(); // DEBUG: Start/Resume session.

        $viewModel = new AdminViewModel();
        $_SESSION["sessionError"] = null;

        // NOTE: Catch unauthorised users before processing the request:
        if (!empty($_SESSION["currentUser"])) {
            if ($_SESSION["currentUser"]->userType != "Administrator") {
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
                $viewModel->students = $this->fetch_students($_inputSearch);

                if (isset($viewModel->students)) {
                    foreach ($viewModel->students as $student) {
                        $modules = array();

                        if (isset($student->enrolments)) {
                            foreach ($student->enrolments as $enrolment) {
                                $_modules = $this->fetch_modules($enrolment->moduleID);

                                if (isset($_modules)) {
                                    foreach ($_modules as $module) {
                                        $module->lessons = $this->fetch_lessons($module->moduleID);

                                        if (isset($module->lessons)) {
                                            array_push($modules, clone $module);
                                        } else {
                                            $_SESSION["sessionError"] = "Unable to fetch lessons: no lessons present.";
                                        }
                                    }
                                } else {
                                    $_SESSION["sessionError"] = "Unable to fetch modules: no modules present.";
                                }
                            }
                        } else {
                            $_SESSION["sessionError"] = "Unable to fetch enrolments: no enrolments present.";
                        }

                        $timetable = new Timetable();
                        $timetable->schedule = array();

                        // TODO: Organize timetable.
                        foreach ($modules as $module) {
                            $lessons = array();

                            for ($x = 0; $x < 12; $x++) { // NOTE: Weeks.
                                $group = array();

                                foreach ($module->lessons as $lesson) {
                                    $lesson->attendance = $this->fetch_attendance($lesson->classID, ($x + 1));
                                    array_push($group, clone $lesson);
                                }

                                array_push($lessons, $group);
                            }

                            array_push($timetable->schedule, $lessons);
                        }

                        $student->timetable = $timetable;
                        $viewModel->modules = $modules;

                        if (!isset($student->timetable->schedule)) {
                            $_SESSION["sessionError"] = "Unable to fetch timetable schedule: no timetable schedule present.";
                        }
                    }

                    $this->load->view('admin', $viewModel);
                } else {
                    $_SESSION["sessionError"] = "Unable to fetch students: no students present.";
                    $this->load->view('admin', $viewModel);
                }
            } else {
                $_SESSION["sessionError"] = "Please specify a student to search for.";
                $this->load->view('admin', $viewModel);
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->load->view('admin', $viewModel);
        }
    }

    public function save() {
        include_once('application/models/Attendance.php');

        $this->load->database();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["attendance"])) {
                $_records = $_POST["attendance"];
                $_student = $_POST["student"];
                $records = array();

                foreach ($_records as $_record) {
                    $_record = str_replace('[', '', $_record);
                    $_record = str_replace(']', '', $_record);

                    $_split = explode(', ', $_record);
                    $_attendance = new Attendance();

                    for ($x = 0; $x < count($_split); $x++) {
                        if ($x == 0) {
                            $_attendance->attendanceID = $_split[$x];
                        } else {
                            $_attendance->attended = $_split[$x];
                        }
                    }

                    $_attendance->studentID = $_student;
                    array_push($records, clone $_attendance);
                }

                // TODO: Support 'late' state.
                $this->commit_attendance($records);
            }

            $this->load->helper('url');
            redirect(base_url() . 'index.php/admin', 'location'); // DEBUG: Redirect back to the 'admin' page.
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->load->helper('url');
            redirect(base_url() . 'index.php/admin', 'location'); // DEBUG: Redirect back to the 'admin' page.
        }
    }

    public function commit_attendance($records) {
        $success = false;

        try {
            foreach($records as $record) {
                $queryString = "UPDATE `attendance` SET `Attended` = ? WHERE `AttendanceID` = ? AND `StudentID` = ?;";
                $queryResult = $this->db->query($queryString, array($record->attended, $record->attendanceID, $record->studentID));

                $success = $queryResult;
            }
        } catch (PDOException $exception) {
            return $success;
        }

        return $success;
    }

    public function fetch_students($inputSearch) {
        $students = array();

        try {
            $queryString = "SELECT * FROM `students` WHERE CONCAT(`FirstName`, `LastName`) LIKE ?;";
            $_inputSearch = "%" . $inputSearch . "%";
            $queryResult = $this->db->query($queryString, array($_inputSearch));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $studentModel = new Student();

                    $studentModel->studentID = $row->StudentID;
                    $studentModel->firstName = $row->FirstName;
                    $studentModel->lastName = $row->LastName;
                    $studentModel->email = $row->Email;
                    $studentModel->concern = $row->Concern;
                    $studentModel->type = $row->Type;
                    $studentModel->userID = $row->UserID;

                    $studentModel->enrolments = $this->fetch_enrolments($studentModel->studentID);

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

    public function fetch_enrolments($studentID) {
        $enrolments = array();

        try {
            $queryString = "SELECT * FROM `modules.students` WHERE `StudentID` = ?;";
            $queryResult = $this->db->query($queryString, array($studentID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $enrolment = new Enrolment();

                    $enrolment->moduleID = $row->ModuleID;
                    //$enrolment->studentID = $row->StudentID; // NOTE: Not needed in this context.
                    $enrolment->startDate = $row->StartDate;
                    $enrolment->endDate = $row->EndDate;

                    array_push($enrolments, $enrolment);
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $enrolments;
    }

    public function fetch_modules($moduleID) {
        $modules = array();

        try {
            $queryString = "SELECT * FROM `modules` WHERE `ModuleID` = ?;";
            $queryResult = $this->db->query($queryString, array($moduleID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $moduleModel = new Module();

                    $moduleModel->moduleID = $row->ModuleID;
                    $moduleModel->staffID = $row->StaffID;
                    $moduleModel->title = $row->Title;
                    $moduleModel->dateCreated = $row->DateCreated;
                    $moduleModel->lastEdited = $row->LastEdited;

                    array_push($modules, $moduleModel);
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $modules;
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
}
