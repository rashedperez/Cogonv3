<?php

class Sms {

    protected $API_KEY = 'a03b8e60866d200b88f700560e6c86f0';

    function send($recipient, $message) {

        try {

            // Para send, himoa FALSE ug ganahan ka musend jud sa number
            if (TRUE) {
                return TRUE;
            }

            // Initialize curl
            $ch = curl_init();

            // Curl params
            $parameters = array(
                'apikey' => $this->API_KEY,
                'number' => $recipient,
                'message' => $message
            );

            // Set curl options
            curl_setopt($ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            // Execute curl
            $response = curl_exec($ch);

            // Close curl
            curl_close($ch);

            // Failed to send sms
            if (!$response) {
                throw new Exception();
            }

            // Decode response
            $response = json_decode($response);

            // Check if sent
            if (!isset($response[0]->message_id)) {
                throw new Exception();
            }

            return $response;
        }
        catch (Exception $e) {
            return FALSE;
        }        
    }
}