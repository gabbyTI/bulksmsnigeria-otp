<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    */

    'api_key' => env('BULKSMSNIGERIA_API_KEY', 'API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Sender ID
    |--------------------------------------------------------------------------
    |
    */

    'sender_id' => env('BULKSMSNIGERIA_SENDER_ID', 'CoinageNG'),



    /*
    |--------------------------------------------------------------------------
    | DND
    |--------------------------------------------------------------------------
    |
    |  Use this to set your DND Management option.
    |  The available options are 1, 2, 3, 4 and 5.
    |  1 is for "Get A Refund for MTN DND numbers"
    |  2 is for "Resend to MTN DND Numbers via Hosted SIM"
    |  3 is for "Send to All Nigerian Numbers Via Hosted SIM Card"
    |  4 is for "Dual-Backup Guaranteed Delivery to All Active Nigerian GSM Numbers"
    |  5 is for "Dual-Dispatch Guaranteed Delivery to All Active Nigerian GSM Numbers"
    |  Options 2-5 is only available after KYC Verification. Default DND option is 2 (i.e. "Resend to MTN DND numbers via Hosted SIM") if your have completed your KYC Verification.
    |
    */

    'dnd' => env('BULKSMSNIGERIA_DND', '3'),


];
