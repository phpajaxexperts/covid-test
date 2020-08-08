<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Name of the Config file
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'name' => 'Triv Pro Core Settings',

    /*
    |--------------------------------------------------------------------------
    | File Types
    |--------------------------------------------------------------------------
    |
    | Here you may configure the Core file types. 
    |
    */

    'file_types' => [
        '1' => [
            'name' => 'Word',
            'icon' => 'msword/word_icon',
            'extentions' => ['doc','docx']
        ],

        '2' => [
            'name' => 'PDF',
            'icon' => 'pdf/pdf_icon',
            'extentions' => ['pdf']
        ],

        '3' => [
            'name' => 'Excel',
            'icon' => 'excel/excel_icon',
            'extentions' => ['xls','xlsx']
        ],
    ],
];
