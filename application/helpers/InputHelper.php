<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InputHelper {
    public function validate($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
}
?>
