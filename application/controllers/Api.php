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

        try {

            // Mobile Number
            $mobile_number = $this->input->post('number');

            // Tan awn ug naa ba number
            if (!$mobile_number) {
                throw new Exception('No mobile number specified');
            }

            $ch = curl_init();

            $parameters = array(
                'apikey' => 'API Key',
                'number' => $to,
                'message' => $message
            );

            curl_setopt($ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            $output = curl_exec($ch);

            curl_close ($ch);
            
            // Failed to send sms
            if (!$output) {
                throw new Exception('Failed to send SMS. Please try again later');
            }

            // Generate OTP
            $response = array(
                'status' => TRUE,
                'otp' => random_string('numeric', 4)
            );
        }
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }

}