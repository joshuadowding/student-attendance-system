<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// db->modules.classes
class Lesson {
    public $classID;
    public $moduleID;
    public $staffID;
    public $startDate;
    public $endDate;
    public $day;
    public $startTime;
    public $endTime;
    public $classType;

    public $attendance;
    public $enrolments;
}
?>
