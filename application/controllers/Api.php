<?php

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Tan awn ug mangayo siyag request
        if (!$this->input->post('make_request')) {
            http_response_code(404); die();
        }
    }

    // Buhat ug otp
    public function generate_otp() {

        // Mobile Number
        $mobile_number = $this->input->post('number');

        // Tan awn ug naa ba number
        if (!$mobile_number) {
            echo json_encode(array(
                'message' => 'No mobile number specified'
            )); die();
        }

        // Generate OTP
        $response = array(
            'status' => TRUE,
            'otp' => random_string('numeric', 4)
        );

        echo json_encode($response);
    }

}