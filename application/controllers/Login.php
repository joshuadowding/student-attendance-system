<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller {
    public $id = null;

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
        include_once('application/helpers/InputHelper.php');

        session_start(); // DEBUG: Start/Resume session.

        $this->load->helper('url');
        $this->load->database();

        $_SESSION["currentUser"] = null; // NOTE: Remove existing user from session.

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->process()) {
                if ($this->retrieve()) {
                    switch ($_SESSION["currentUser"]->userType) {
                        case "Student":
                            redirect(base_url() . "index.php/student", 'location');
                            break;

                        case "Lecturer":
                            redirect(base_url() . "index.php/lecturer", 'location');
                            break;

                        case "Manager":
                            redirect(base_url() . "index.php/manager", 'location');
                            break;

                        case "Administrator":
                            redirect(base_url() . "index.php/admin", 'location');
                            break;

                        default:
                            $_SESSION["loginError"] = "Unable to determine account type; please try again.";
                            redirect(base_url(), 'location'); // DEBUG: Go back to login screen on login failure.
                            break;
                    }
                } else {
                    if(!isset($_SESSION["internalError"])) {
                        $_SESSION["loginError"] = "Unable to retrieve user information; please try again.";
                    }

                    redirect(base_url(), 'location'); // DEBUG: Go back to login screen on login failure.
                }
            } else {
                if(!isset($_SESSION["internalError"])) {
                    $_SESSION["loginError"] = "Invalid user credentials; please try again.";
                }

                redirect(base_url(), 'location'); // DEBUG: Go back to login screen on login failure.
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->load->view('login');
        }

        // DEBUG: Uncomment to conduct unit tests.
        // $this->test_retrieve();
        // $this->test_process();
    }

    // Process the input and search for the corresponding user in the db.users database. (Josh)
    public function process() {
        $validationSuccess = false; // NOTE: Result
        $inputUsername = null;
        $inputPassword = null;

        $inputHelper = new InputHelper();

        if (!empty($_POST["input-username"])) {
            $inputUsername = $inputHelper->validate($_POST["input-username"]);
        } else {
            return $validationSuccess;
        }

        if (!empty($_POST["input-password"])) {
            $inputPassword = $inputHelper->validate($_POST["input-password"]);
        } else {
            return $validationSuccess;
        }

        $username = null;
        $password = null;

        try {
            $queryString = "SELECT * FROM `users` WHERE `Username` = ?;";
            $queryResult = $this->db->query($queryString, array($inputUsername));

            if ($queryResult->num_rows() != 0) {
                $password = $queryResult->row()->Password;

                if (password_verify($inputPassword, $password)) {
                    $username = $queryResult->row()->Username;
                    $this->id = $queryResult->row()->UserID;

                    $validationSuccess = true;
                } else {
                    return $validationSuccess;
                }
            } else {
                return $validationSuccess;
            }
        } catch (PDOException $exception) {
            $_SESSION["internalError"] = "Internal server error; please try again.";
            return $validationSuccess;
        }

        $_SESSION["loginError"] = null; // NOTE: Remove any error that might already be present.
        $_SESSION["internalError"] = null;

        return $validationSuccess;
    }

    // Retrieve the user's details from either the db.students or db.staff databases. (Josh)
    private function retrieve() {
        $retrievalSuccess = false;

        try {
            $queryString = "SELECT `FirstName`, `LastName`, `Email`, `UserID`, `Type` FROM `students` UNION SELECT `FirstName`, `LastName`, `Email`, `UserID`, `Type` FROM `staff`;";
            $queryResult = $this->db->query($queryString);

            if ($queryResult->num_rows() != 0) {
                foreach ($queryResult->result() as $row) {
                    if ($row->UserID == $this->id) {
                        $userModel = new User();

                        $userModel->userFirstName = $row->FirstName;
                        $userModel->userLastName = $row->LastName;
                        $userModel->userEmail = $row->Email;
                        $userModel->userID = $row->UserID;
                        $userModel->userType = $row->Type;

                        $retrievalSuccess = true;
                        $_SESSION["currentUser"] = $userModel; // NOTE: Assign populated user model to session.
                    }
                }
            } else {
                return $retrievalSuccess;
            }
        } catch (PDOException $exception) {
            $_SESSION["internalError"] = "Internal server error; please try again.";
            return $retrievalSuccess;
        }

        $_SESSION["loginError"] = null; // NOTE: Remove any error that might already be present.
        $_SESSION["internalError"] = null;

        return $retrievalSuccess;
    }

    /*
     * Unit Tests (CodeIgniter)
     */

    // Test process to see whether it can process user input correctly. (Josh)
    private function test_process() {
        $this->load->library('unit_test');

        // TODO: I realize this is bad (improve):
        $_POST["input-username"] = "josh.dowding";
        $_POST["input-password"] = "test1";

        $this->process();

        $test = $this->id;
        $result = "2"; // Result: the user has been found!
        $name = "test_retrieve";

        $this->unit->run($test, $result, $name);

        $this->id = null; // Remove, just in-case.

        echo $this->unit->report();
    }

    // Test retrive to see whether it can successfully reach the database. (Josh)
    private function test_retrieve() {
        $this->load->library('unit_test');

        $this->id = "2";

        $test = $this->retrieve();
        $result = true; // Result: a user has been found!
        $name = "test_retrieve";

        $this->unit->run($test, $result, $name);

        $this->id = null; // Remove, just in-case.

        echo $this->unit->report();
    }
}
?>
