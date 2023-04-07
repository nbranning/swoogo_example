<?php

return [
    'base_url' => 'https://api.swoogo.com/api/v1/',
    'api_key' => env('SWOOGO_KEY', 0),
    'api_secret' => env('SWOOGO_SECRET', 0),
    //event_id would probably a dynamic number passed in instead of me supplying it but Ill just put it here for ease
    'event_id' => env('SWOOGO_EVENT_ID', 0),
];