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

            // Generate OTP
            $code = random_string('numeric', 4);
                
            // Send SMS
            $send_attempt = $this->sms->send($mobile_number, "Hi, your verification OTP is $code. Please share this code with the Barangay Administrator at Cogon Pardo. Thanks!");

            // Send failed
            if (!$send_attempt) {
                throw new Exception('Failed to send SMS. Please try again later');
            }

            // Set code
            $this->session->set_tempdata('verification_code', $code, 200);

            // Generate OTP
            $response = array(
                'status' => TRUE,
                'otp' => $code
            );
        }
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }

    // Verify OTP
    public function verify_otp() {

        try {

            // Input
            $input = $this->input->post('code');

            // Tan awn ug naa ba number
            if (!$input) {
                throw new Exception('Please enter code');
            }

            // Generate OTP
            $code = $this->session->userdata('verification_code');

            if ($input !== $code) {
                throw new Exception('Invalid code');
            }

            // Generate OTP
            $response = array(
                'status' => TRUE,
                'message' => 'Verified'
            );
        }
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }

    // Notify sa tanan resident
    public function notify_resident() {

        try {

            // Get message
            $message = trim($this->input->post('message'));

            // Tan awn ug naa ba number
            if (!$message) {
                throw new Exception('Please specify your message');
            }

            // Check if message reached max
            if (strlen($message) > 150) {
                throw new Exception('Message is too long');
            }

            // Get all residents
            $residents = $this->resident_model->get_all_resident();

            // Iterate residents
            foreach ($residents as $resident) {
                $this->sms->send($resident->contact_num, $message);
            }

            $response = array(
                'status' => TRUE,
                'message' => 'Residents notified!'
            );
        }
        catch (Exception $e) {
            $response['message'] = $e->getMessage();
        }

        echo json_encode($response);
    }
}