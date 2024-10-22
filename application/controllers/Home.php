<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller {

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
         $this->load->helper("url");
        //print_r($_SESSION["currentUser"]->userType);
        //exit;
        if(isset( $_SESSION["currentUser"]->userType) && $_SESSION["currentUser"]->userType == "Manager"){
            redirect(base_url()."index.php/manager/", 'location');

        }
        $this->load->database();
        $this->load->view('home');
		
    }
}
