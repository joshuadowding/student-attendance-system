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

        include_once('application/models/view_models/AdminViewModel.php'); // NOTE: View Model

        session_start(); // DEBUG: Start/Resume session.

        if (!empty($_SESSION["currentUser"])) {
            if ($_SESSION["currentUser"]->userType == "Administrator") {
                $this->load->database();

                $viewModel = new AdminViewModel();

                $viewModel->modules = $this->fetch_modules();
                $this->fetch_lessons($viewModel->modules);

                $viewModel->students = $this->fetch_students();
                $this->fetch_enrolments($viewModel->modules, $viewModel->students);

                $viewModel->attendance = $this->fetch_attendance();

                $this->load->view('admin', $viewModel);
            } else {
                $this->load->helper('url');
                redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (home) page.
            }
        } else {
            $this->load->helper('url');
            redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (home) page.
        }
    }

    public function fetch_students() {
        $students = array();

        try {
            $queryString = "SELECT * FROM `students`;";
            $queryResult = $this->db->query($queryString);

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

                    array_push($students, $studentModel);
                }
            } else {
                $_SESSION["loginError"] = "Unable to fetch students: no students present.";
                return null;
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
            return null;
        }

        return $students;
    }

    public function fetch_enrolments($modules, $students) {
        $success = false;

        try {
            $queryString = "SELECT * FROM `modules.students`;";
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $enrolmentModel = new Enrolment();

                    $enrolmentModel->moduleID = $row->ModuleID;
                    $enrolmentModel->studentID = $row->StudentID;
                    $enrolmentModel->startDate = $row->StartDate;
                    $enrolmentModel->endDate = $row->EndDate;

                    $moduleModel = null;
                    foreach ($modules as $module) {
                        if ($module->moduleID == $enrolmentModel->moduleID) {
                            $moduleModel = $module;
                        }
                    }

                    foreach ($students as $student) {
                        if ($student->studentID == $enrolmentModel->studentID) {
                            array_push($moduleModel->students, $student);
                        }
                    }
                }

                $success = true;
            } else {
                $_SESSION["loginError"] = "Unable to fetch enrolments: no enrolments present.";
                return $success;
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
            return $success;
        }

        return $success;
    }

    public function fetch_modules() {
        $modules = array();

        try {
            $queryString = "SELECT * FROM `modules`;";
            $queryResult = $this->db->query($queryString);

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
                $_SESSION["loginError"] = "Unable to fetch modules: no modules present.";
                return null;
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
            return null;
        }

        return $modules;
    }

    public function fetch_lessons($modules) {
        $success = false;

        try {
            $queryString = "SELECT * FROM `modules.classes`;";
            $queryResult = $this->db->query($queryString);

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

                    foreach ($modules as $module) {
                        if ($module->moduleID == $lessonModel->moduleID) {
                            array_push($module->lessons, $lessonModel);
                        }
                    }
                }

                $success = true;
            } else {
                $_SESSION["loginError"] = "Unable to fetch lessons: no lessons present.";
                return $success;
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
            return $success;
        }

        return $success;
    }

    public function fetch_attendance() {
        $attendance = array();

        try {
            $queryString = "SELECT * FROM `attendance`;";
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    $attendanceModel = new Attendance();

                    $attendanceModel->attendanceID = $row->AttendanceID;
                    $attendanceModel->classID = $row->ClassID;
                    $attendanceModel->studentID = $row->StudentID;
                    $attendanceModel->attended = $row->Attended;
                    $attendanceModel->late = $row->Late;
                    $attendanceModel->week = $row->Week;

                    array_push($attendance, $attendanceModel);
                }
            } else {
                $_SESSION["loginError"] = "Unable to fetch attendance: no attendance records present.";
                return null;
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
            return null;
        }

        return $attendance;
    }
}
