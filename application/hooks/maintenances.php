<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class maintenances {

    var $CI;

    public function maintenance() {
        $this->CI = & get_instance();
        $this->CI->load->config("config_maintenance");
        if (config_item("maintenance_mode")) {
            include(APPPATH . '/views/errors/html/maintance.php');
            die();
        }
    }

}
