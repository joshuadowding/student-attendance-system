<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage extends CI_Controller {

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

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $modules = $this->fetch_modules();

            if (isset($modules)) {
                foreach ($modules as $module) {
                    $module->lessons = $this->fetch_lessons($module->moduleID);
                }
            }

            $timetable = new Timetable();
            $timetable->schedule = array();

            foreach ($modules as $module) {
                $schedule = array();

                for ($x = 0; $x < 12; $x++) { // NOTE: Weeks.
                    $lessons = array();

                    foreach ($module->lessons as $lesson) {
                        $lesson->attendance = $this->fetch_attendance($lesson->classID, ($x + 1));
                        //$lesson->enrolments = $this->fetch_enrolments($module->moduleID);

                        if (isset($lesson->attendance)) {
                            array_push($lessons, clone $lesson);
                        } else {
                            $lesson->attendance = array();

                            $attendance = new Attendance();
                            $attendance->classID = $lesson->classID;
                            //$attendance->studentID =
                            $attendance->attended = 0;
                            $attendance->late = 0;
                            $attendance->week = ($x + 1);

                            array_push($lesson->attendance, $attendance);
                            array_push($lessons, clone $lesson);
                        }
                    }

                    array_push($schedule, $lessons);
                }

                array_push($timetable->schedule, $schedule);
            }

            $this->load->view('manage', $viewModel);
        }
    }

    private function fetch_modules() {
        $modules = array();

        try {
            $queryString = "SELECT * FROM `modules`;";
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $module = new Module();

                    $module->moduleID = $row->ModuleID;
                    $module->staffID = $row->StaffID;
                    $module->title = $row->Title;
                    $module->dateCreated = $row->DateCreated;
                    $module->lastEdited = $row->LastEdited;

                    array_push($modules, clone $module);
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $modules;
    }

    private function fetch_lessons($moduleID) {
        $lessons = array();

        try {
            $queryString = "SELECT * FROM `modules.classes` WHERE `ModuleID` = ?;";
            $queryResult = $this->db->query($queryString, array($moduleID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $lesson = new Lesson();

                    $lesson->classID = $row->ClassID;
                    $lesson->moduleID = $row->ModuleID;
                    $lesson->staffID = $row->StaffID;
                    $lesson->startDate = $row->StartDate;
                    $lesson->endDate = $row->EndDate;
                    $lesson->day = $row->Day;
                    $lesson->startTime = $row->StartTime;
                    $lesson->endTime = $row->EndTime;
                    $lesson->classType = $row->ClassType;

                    array_push($lessons, clone $lesson);
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $lessons;
    }

    private function fetch_attendance($classID, $weekNum) {
        $records = array();

        try {
            $queryString = "SELECT * FROM `attendance` WHERE `ClassID` = ? AND `Week` = ?;";
            $queryResult = $this->db->query($queryString, array($classID, $weekNum));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $attendance = new Attendance();

                    $attendance->attendanceID = $row->AttendanceID;
                    $attendance->classID = $row->ClassID;
                    $attendance->studentID = $row->StudentID;
                    $attendance->attended = $row->Attended;
                    $attendance->late = $row->Late;
                    $attendance->week = $row->Week;

                    array_push($records, clone $attendance);
                }
            } else {
                return null;
            }
        } catch (PDOException $exception) {
            return null;
        }

        return $records;
    }

    private function fetch_enrolments($moduleID) {
        $enrolments = array();

        try {
            $queryString = "SELECT * FROM `modules.students` WHERE `ModuleID` = ?;";
            $queryResult = $this->db->query($queryString, array($moduleID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $enrolment = new Enrolment();

                    $enrolment->enrolmentID = $row->EnrolmentID;
                    $enrolment->moduelID = $row->ModuleID;
                    $enrolment->studentID = $row->StudentID;
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
}
