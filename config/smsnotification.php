<?php

return [
    'driver'    => env('SMS_OUTBOUND', 'twillio'),
    'twillio' => [
        'auth_id'       => env('TWILIO_SID', '--twillio-service-id--'),
        'auth_token'    => env('TWILIO_AUTH_TOKEN', '--twillio-auth-token--'),
        'sender_no'     => env('TWILIO_NUMBER', '--twillio-sender-number--'),
        'service_id'    => env('TWILIO_SERVICE_ID', '--twillio-service-id--'),
        'timeout'       => 30.0, // in second
    ],
];