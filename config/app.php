<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Proxy Active?
    |--------------------------------------------------------------------------
    |
    | Determines whether the rewriting of the URLs is active. Default is true.
    |
    */
    'app_secret' => env('APP_SECRET', ''),
    'name' => env('APP_NAME', 'Lumen'),
    'user_id_prefix' => env('USER_ID_PREFIX', ''),
    'uid_prefix' => env('UID_PREFIX', ''),
];