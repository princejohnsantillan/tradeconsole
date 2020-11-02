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

    'adapter_version' => '0.12',

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
