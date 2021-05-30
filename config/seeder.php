<?php
/*
 *  STRUCTURE OF THE CONFIG FILE
 *  ----------------------------
 *  [
 *      'table name:amount' => [ 
 *          'column' => 'faker:faker_formatter | text:string | number:number | boolean:true/false | date:timestamp | password:string', 
 *          'column' => 'faker:faker_formatter | text:string | number:number | boolean:true/false | date:timestamp | password:string', 
 *          ... 
 *      ],
 *      'table_name:amount' => [
 *          ...
 *      ]
 *  ]
 * 
 *  COLUMNS
 *  -------
 *  type:value | :method[:length] | :min:max
 * 
 *  Sie below for examples
 */

return [
    'klassen:2' => [
        'klasnaam' => 'faker:word',
        'mentor' => 'faker:name'
    ],
    'docenten:4' => [
        'naam' => 'faker:name',
        'afkorting' => 'faker:randomChars:3:uppercase',
        'geslacht' => 'faker:gender:1:uppercase'
    ]
];