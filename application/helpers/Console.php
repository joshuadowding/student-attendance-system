<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Console {
    /* Modified from: https://stackify.com/how-to-log-to-console-in-php/ */
    public function console_log($output, $with_script_tags = true) {
        $js = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';

        if($with_script_tags) {
            $js = '<script>' . $js . '</script>';
        }

        echo $js;
    }
}
?>