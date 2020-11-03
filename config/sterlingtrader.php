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
    | Link to the latest adapter.
    |
    */

    'adapter_download' => env('STERLING_TRADER_ADAPTER_DOWNLOAD', '#'),

    /*
    |--------------------------------------------------------------------------
    | Console Address
    |--------------------------------------------------------------------------
    |
    | Use this address when connecting to Trade Console from the
    | platform adapter.
    |
    */

    'console_address' => env('STERLING_TRADER_CONSOLE_ADDRESS'),

];
