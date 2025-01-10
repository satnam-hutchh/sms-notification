<?php

return [
    'driver'    => env('SMS_OUTBOUND', 'twilio'),
    'twilio' => [
        'auth_id'       => env('TWILIO_SID', '--twilio-service-id--'),
        'auth_token'    => env('TWILIO_AUTH_TOKEN', '--twilio-auth-token--'),
        'sender_no'     => env('TWILIO_NUMBER', '--twilio-sender-number--'),
        'service_id'    => env('TWILIO_SERVICE_ID', '--twilio-service-id--'),
        'timeout'       => 30.0, // in second
    ],
];