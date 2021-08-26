<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Adapter Version
    |--------------------------------------------------------------------------
    |
    | Enforce users to use a specfic adapter version. The latest version is
    | recommended.
    |
    */

    'adapter_version' => env('STERLING_TRADER_ADAPTER_VERSION'),

    /*
    |--------------------------------------------------------------------------
    | Adapter Download Link
    |--------------------------------------------------------------------------
    |
    | Provide a download link to the latest adapter.
    |
    */

    'adapter_download' => env('STERLING_TRADER_ADAPTER_DOWNLOAD', '#'),

    /*
    |--------------------------------------------------------------------------
    | Console Address
    |--------------------------------------------------------------------------
    |
    | Use this address when connecting to The Pulse Plus from the
    | Sterling Trader adapter.
    |
    */

    'console_address' => env('STERLING_TRADER_CONSOLE_ADDRESS'),

];
