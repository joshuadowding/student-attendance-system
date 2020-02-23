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
				// TODO: Failed to login:
				$this->load->view('login');
			}
		}
		else if($_SERVER["REQUEST_METHOD"] == "GET") {
			$this->load->view('login');
		}
	}

	public function process() {
		$validationSuccess = true;
		$inputUsername = "";
		$inputPassword = "";

		if(!empty($_POST["input-username"])) {
			$inputUsername = $this->validate($_POST["input-username"]);
		}
		else {
			$validationSuccess = false;
			exit('Invalid Request');
		}

		if(!empty($_POST["input-password"])) {
			$inputPassword = $this->validate($_POST["input-password"]);
		}
		else {
			$validationSuccess = false;
			exit('Invalid Request');
		}

		$result = $this->db->query("SELECT * FROM `students` WHERE `Username`='" . $inputUsername . "';");
		if($result->num_rows() != 0) {
			$username = $result->row();
			//$username = $result->row_object(0)->Username;
		}

		if(isset($username)) {
			$_SESSION["currentUsername"] = $username->Username;
		}
		else {
			$_SESSION["loginError"] = "Invalid Username";
			$validationSuccess = false;
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