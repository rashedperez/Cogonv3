<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/
$hook['pre_controller'][] = function() {
    date_default_timezone_set('Asia/Manila');
};

$hook['post_controller'][] = function () {

    $CI =& get_instance();
    $RTR =& load_class('Router');

    // Pugos pa change pass
    if ($CI->session->userdata('reset_password_user_id') && $RTR->method !== 'reset_password' && $RTR->method !== 'update_new_password') {
        redirect('user/reset_password');
    }
    else if (!$CI->session->userdata('reset_password_user_id') && $RTR->method == 'reset_password') {
        redirect('dashboard');
    }
};