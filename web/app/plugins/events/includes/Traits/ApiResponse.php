<?php

namespace Events\Traits;

trait ApiResponse
{
    public function sendResponse($message, $data = null, $code = 200)
    {
        // Prepare the response structure
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        // Set HTTP status code
        status_header($code);

        // Send JSON response
        wp_send_json($result);
    }
}
