<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('print_out')) {

    function print_out($array = array(), $continue = false) {
        echo '<pre>' . print_r($array, TRUE) . '</pre>';
        if ($continue)
            die;
    }

}





if (!function_exists('auth_user')) {

    function auth_user() {
        $ini = &get_instance();
        $name = $ini->session->userdata('username');
        if (!isset($name)) {
            redirect(base_url() . 'login');
        }
    }

}