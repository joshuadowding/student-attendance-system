<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		session_start(); // DEBUG: Start/Resume session.

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$this->load->database();

			if($this->process()) {
				if($this->retrieve()) {
					$this->load->helper('url');
					redirect(base_url(), 'location'); // DEBUG: Redirect back to the 'index' (home) page.
				}
				else {
					// NOTE: Unable to retrieve user information. Display error(?).
					$_SESSION["loginError"] = "Unable to retrieve user information.";
					$this->load->view('login'); // DEBUG: Go back to login screen on login failure.
				}
			}
			else {
				$_SESSION["loginError"] = "Unable to retrieve user credentials.";
				$this->load->view('login'); // DEBUG: Go back to login screen on login failure.
			}
		}
		else if($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION["currentUser"] = null; // NOTE: Remove existing user from session.
			$this->load->view('login');
		}
	}

	public function process() {
		$validationSuccess = false; // NOTE: Result
		$inputUsername = null;
		$inputPassword = null;

		if(!empty($_POST["input-username"])) {
			$inputUsername = $this->validate($_POST["input-username"]);
		}
		else {
			$_SESSION["loginError"] = "Invalid Username";
			return $validationSuccess;
		}

		if(!empty($_POST["input-password"])) {
			$inputPassword = $this->validate($_POST["input-password"]);
		}
		else {
			$_SESSION["loginError"] = "Invalid Password";
			return $validationSuccess;
		}

		$username = null;
		$password = null;

		try {
			$queryString = "SELECT * FROM `users` WHERE `Username` = ?;";
			$queryResult = $this->db->query($queryString, array($inputUsername));
			if($queryResult->num_rows() != 0) {
				$username = $queryResult->row()->Username;
			}
			else {
				$_SESSION["loginError"] = "Invalid Username";
				return $validationSuccess;
			}
	
			$queryString = "SELECT * FROM `users` WHERE `Password` = ?;";
			$queryResult = $this->db->query($queryString, array($inputPassword));
			if($queryResult->num_rows() != 0) {
				$password = $queryResult->row()->Password;
				$this->id = $queryResult->row()->UserID;
			}
			else {
				$_SESSION["loginError"] = "Invalid Password";
				return $validationSuccess;
			}
		}
		catch(PDOException $exception) {
			$_SESSION["loginError"] = "Internal Server Error";
			return $validationSuccess;
		}

		if(isset($username) && isset($password)) {
			$_SESSION["loginError"] = null; // NOTE: Remove any error that might already be present.
			$validationSuccess = true;
		}

		return $validationSuccess;
	}

	private function retrieve() {
		$retrievalSuccess = false;

		try {
			$queryString = "SELECT `FirstName`, `LastName`, `Email`, `UserID`, `Type` FROM `students` UNION SELECT `FirstName`, `LastName`, `Email`, `UserID`, `Type` FROM `staff`;";
			$queryResult = $this->db->query($queryString);
			if($queryResult->num_rows() != 0) {
				foreach($queryResult->result() as $row) {
					if($row->UserID == $this->id) {
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
			}
			else {
				$_SESSION["loginError"] = "Unable to retrieve user credentials: not found.";
				return $retrievalSuccess;
			}
		}
		catch(PDOException $exception) {
			$_SESSION["loginError"] = "Internal Server Error";
			return $retrievalSuccess;
		}

		return $retrievalSuccess;
	}

	private function validate($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}
}