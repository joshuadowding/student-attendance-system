<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class manager extends CI_Controller {

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
		session_start(); // DEBUG: Start/Resume session.

		$this->load->database();
		$this->load->view('manager');
	}
}
