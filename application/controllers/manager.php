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
     function index() {
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

}