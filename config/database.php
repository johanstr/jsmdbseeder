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
    'users:10' => [
        'name' => 'faker:name',
        'email' => 'faker:freeEmail',
        'password' => 'password:welkom',
        'is_admin' => 'number:0',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp'
    ],
    'threads:20' => [
        'title' => 'faker:sentence:5',
        'description' => 'faker:paragraph:4',
        'user_id' => 'rand:1:10',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp'
    ],
    'topics:50' => [
        'title' => 'faker:sentence:5',
        'body' => 'faker:paragraph:10',
        'user_id' => 'rand:1:10',
        'thread_id' => 'rand:1:20',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp'
    ],
    'replies:100' => [
        'body' => 'faker:paragraph:10',
        'user_id' => 'rand:1:10',
        'topic_id' => 'rand:1:50',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp'
    ]
];