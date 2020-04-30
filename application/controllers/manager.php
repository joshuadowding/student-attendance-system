<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager extends CI_Controller {
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        include_once('application/models/Room.php');
        include_once('application/models/User.php');
        include_once('application/models/Student.php');
        include_once('application/models/Module.php');
        include_once('application/models/Enrolment.php');
        include_once('application/models/Lesson.php');
        include_once('application/models/Attendance.php');
        include_once('application/models/Timetable.php');
        include_once('application/models/BadAttendance.php');

        include_once('application/helpers/InputHelper.php');

        include_once('application/models/view_models/ManagerViewModel.php'); // NOTE: View Model

        session_start(); // DEBUG: Start/Resume session.

        $viewModel = new ManagerViewModel();
        $_SESSION["sessionError"] = null;

        // NOTE: Catch unauthorised users before processing the request:
        if (!empty($_SESSION["currentUser"])) {
            if ($_SESSION["currentUser"]->userType != "Manager") {
                $_SESSION["loginError"] = "Internal Error: Incorrect User Type";

                $this->load->helper('url');
                redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (login) page.
            } else {
                $this->load->database();
            }
        } else {
            $_SESSION["loginError"] = "Internal Error: Please Login";

            $this->load->helper('url');
            redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (login) page.
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->populate_lecture_attendance($viewModel);
            $this->populate_room_usage($viewModel);
            $this->populate_student_attendance_alert($viewModel);

            $this->load->view('manager', $viewModel);
        } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->populate_lecture_attendance($viewModel);
            $this->populate_room_usage($viewModel);
            $this->populate_student_attendance_alert($viewModel);

            $this->load->view('manager', $viewModel);
        }
    }

    // 'As a manager I want to know which lectures have been poorly attended' Task #5 (Josh)
    private function populate_lecture_attendance($viewModel) {
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
                    $lesson->attendance = $this->fetch_attendance($lesson->classID, ($x + 1)); // Students who DID/DID NOT attend.
                    $lesson->enrolments = $this->fetch_enrolments($module->moduleID); // Students who SHOULD attend.

                    if (isset($lesson->attendance)) {
                        array_push($lessons, clone $lesson);
                    } else {
                        $lesson->attendance = array();

                        $attendance = new Attendance();
                        $attendance->classID = $lesson->classID;
                        //$attendance->studentID = ;
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

        $viewModel->timetable = $timetable;
        $viewModel->modules = $modules;
    }

    // 'As a manager I want to know room usage vs capacity' Task #4 (Janvi)
    private function populate_room_usage($viewModel) {
        $inputSearch = isset($_POST["input-search"]) ? $_POST["input-search"] : null;
        $inputHelper = new InputHelper();

        if (!empty($inputSearch)) {
            $_inputSearch = $inputHelper->validate($inputSearch);

            // TODO: Process input and display relevant output.
            $room = $this->fetch_room($_inputSearch);


            if ($room instanceof Room) {
            } else {
                $_SESSION["sessionError"] = "Unable to fetch rooms : no rooms present.";
            }
            $viewModel->room = $room;

            if (isset($room->capacity->usage)) {
                $_SESSION["sessionError"] = "Unable to fetch capacity usage : no capacity usage present.";
            }
        }
    }

    // 'As a Manager I want to be alerted when a student has attendance below certain thresholds.' Task #3 (Janvi)
    private function populate_student_attendance_alert($viewModel) {
        $inputSearch = isset($_POST["input-search"]) ? $_POST["input-search"] : null;
        $inputHelper = new InputHelper();

        $badAttendees = array();
        $threshold = 20;
        if (!empty($inputSearch)) {
            $threshold = $inputHelper->validate($inputSearch);
            $badAttendees = $this->fetch_bad_attandances($threshold);
        }

        $viewModel->badAttendees = $badAttendees;
        $viewModel->threshold = $threshold;
    }

    // Fetch each module from the db.modules database. (Josh)
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

    // Fetch each lesson from the db.modules.classes database, based on ModuleID. (Josh)
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

    // Fetch each attendance record from the db.attendance database, based on ClassID and Week. (Josh)
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

    // Fetch each enrolment record from the db.modules.students database, based on ModuleID. (Josh)
    private function fetch_enrolments($moduleID) {
        $enrolments = array();

        try {
            $queryString = "SELECT * FROM `modules.students` WHERE `ModuleID` = ?;";
            $queryResult = $this->db->query($queryString, array($moduleID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $enrolment = new Enrolment();

                    $enrolment->enrolmentID = $row->EnrolmentID;
                    $enrolment->moduleID = $row->ModuleID;
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

    // Fetch each room from the db.rooms database, based on RoomID. (Janvi)
    private function fetch_room($roomID) {
        try {
            $queryString = "SELECT * FROM `rooms` WHERE RoomID=?;";
            $queryResult = $this->db->query($queryString, array($roomID));

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {

                    $room = new Room(); //db->rooms table
                    $room->roomID = $row->RoomID;
                    $room->name = $row->Name;
                    $room->location = $row->Location;
                    $room->capacity = (int) $row->Capacity;
                    $room->pcs = (int) $row->PCs;
                    $room->printer = (int) $row->Printer;
                    $room->type = $row->Type;

                    return $room;
                }
            }
        } catch (PDOException $exception) {
        }
    }

    // Fetch each (Janvi)
    private function fetch_bad_attandances($threshold = 20) {
        // ! = NOT logical operand
        if (!is_numeric($threshold)) {
            $threshold = 20;
        }

        if (!($threshold > 0 && $threshold <= 100)) {
            $threshold = 20;
        }

        $badAttendances = array();
        try {
            // $queryString = "SELECT * FROM `attendance` LIMIT ?;";
            $queryString = "SELECT `StudentID`,`StudentName`,`ClassID`,`TotalAttendance`, `ExpectedAttendance`
                            FROM `student_class_total_attendance`
                            WHERE `TotalAttendance` / `ExpectedAttendance` * 100 < {$threshold};";

            // $queryResult = $this->db->query($queryString, array(3));
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $badAttendance = new BadAttendance();
                    $badAttendance->studentID = (int) $row->StudentID;
                    $badAttendance->studentName = $row->StudentName;
                    $badAttendance->classID = $row->ClassID;
                    $badAttendance->attendance = $row->TotalAttendance / $row->ExpectedAttendance * 100;

                    $badAttendances[] = $badAttendance;
                }
            }
        } catch (PDOException $exception) {
        }

        return $badAttendances;
    }
}
