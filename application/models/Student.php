<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // db->students
    class Student {
        public $studentID;
        public $firstName;
        public $lastName;
        public $email;
        public $concern;
        public $type;
        public $userID;

        public $enrolments = array();
        public $timetable;
    }
?>
