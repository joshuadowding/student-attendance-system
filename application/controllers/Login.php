<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		session_start(); // DEBUG: Start/Resume session.

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$this->load->database();

			if($this->process()) {
				$this->load->helper('url');
				redirect(base_url(), 'location'); // DEBUG: Redirect to homepage.
				exit();
			}
			else {
				$this->load->view('login'); // DEBUG: Go back to login screen on login failure.
			}
		}
		else if($_SERVER["REQUEST_METHOD"] == "GET") {
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
			$queryString = "SELECT * FROM `students` WHERE `Username` = ?;";
			$queryResult = $this->db->query($queryString, array($inputUsername));
			if($queryResult->num_rows() != 0) {
				$username = $queryResult->row()->Username;
			}
			else {
				$_SESSION["loginError"] = "Invalid Username";
				return $validationSuccess;
			}
	
			$queryString = "SELECT * FROM `students` WHERE `Password` = ?;";
			$queryResult = $this->db->query($queryString, array($inputPassword));
			if($queryResult->num_rows() != 0) {
				$password = $queryResult->row()->Password;
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

		if(isset($username)) { // TODO: Build user model:
			$_SESSION["currentUsername"] = $username; // DEBUG: Take note of the username.

			if(isset($password)) {
				$_SESSION["loginError"] = null;
				$validationSuccess = true;
			}
		}

		return $validationSuccess;
	}

	private function validate($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}
}