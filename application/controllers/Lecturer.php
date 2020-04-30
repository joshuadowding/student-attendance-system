<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lecturer extends CI_Controller {
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
        include_once('application/models/view_models/LecturerViewModel.php');

        session_start(); // DEBUG: Start/Resume session.

        $viewModel = new LecturerViewModel();
        $_SESSION["sessionError"] = null;

        // NOTE: Catch unauthorised users before processing the request:
        if (!empty($_SESSION["currentUser"])) {
            if ($_SESSION["currentUser"]->userType != "Lecturer") {
                $this->load->helper('url');
                redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (login) page.

                // TODO: Return error 'wrong user type'.
            } else {
                $this->load->database();
            }
        } else {
            $this->load->helper('url');
            redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (login) page.

            // TODO: Return error 'wrong user type'.
        }

        $this->populate_class_attendance($viewModel);
        $this->populate_module_attendance($viewModel);

        $this->load->database();
        $this->load->view('lecturer', $viewModel);
    }

    // attendance by class
    private function populate_class_attendance($viewModel) {
        try {
            $userID = $_SESSION["currentUser"]->userID;

            $queryString = "SELECT concat(m.Title, '-', c.ClassType) as Title, count(*) as count FROM `attendance` a inner join `modules.classes` c on a.ClassID=c.ClassID inner join `modules` m on m.ModuleID=c.ModuleID inner join `Staff` s on s.StaffID=c.StaffID where s.UserID=$userID GROUP by a.ClassID, m.ModuleID;";
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                $dataPoints = array();

                foreach ($queryResult->result() as $row) {
                    $data = array();
                    $data['label'] = $row->Title;
                    $data['y'] = $row->count;
                    array_push($dataPoints, $data);
                }

                $viewModel->classAttendance = $dataPoints;
            } else {
                $_SESSION["loginError"] = "Unable to retrieve user data: not found.";
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
        }
    }

    // attendance by module
    private function populate_module_attendance($viewModel) {
        try {
            $userID = $_SESSION["currentUser"]->userID;

            $queryString = "SELECT m.Title, count(*) as count FROM `attendance` a inner join `modules.classes` c on a.ClassID=c.ClassID inner join `modules` m on m.ModuleID=c.ModuleID inner join `Staff` s on s.StaffID=c.StaffID where s.UserID=$userID GROUP by m.ModuleID;";
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                $dataPoints = array();

                foreach ($queryResult->result() as $row) {
                    $data = array();
                    $data['label'] = $row->Title;
                    $data['y'] = $row->count;
                    array_push($dataPoints, $data);
                }

                $viewModel->moduleAttendance = $dataPoints;
            } else {
                $_SESSION["loginError"] = "Unable to retrieve user data: not found.";
            }
        } catch (PDOException $exception) {
            $_SESSION["loginError"] = "Internal Server Error";
        }
    }
}
