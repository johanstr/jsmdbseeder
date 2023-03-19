<?php

return [
    'users:10' => [                         
        'name' => 'faker:name',             
        'email' => 'faker:freeEmail',      
        'password' => 'password:welkom',    
        'role' => 'number:0',           
        'created_at' => 'date:timestamp',  
        'updated_at' => 'date:timestamp'    
    ],
    'threads:10' => [
        'id' => 'rand:10000:10000000',
        'title' => 'faker:sentence:5',
        'description' => 'faker:paragraph:5',
        'user_id' => 'rand:1:10',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp',
    ],
    'topics:10' => [
        'id' => 'rand:10000:10000000',
        'title' => 'faker:sentence:5',
        'content' => 'faker:paragraph:10',
        'user_id' => 'rand:1:10',
        'thread_id' => 'rand:50:100',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp',
    ],
    'replies:10' => [
        'id' => 'rand:10000:10000000',
        'title' => 'faker:sentence:5',
        'content' => 'faker:paragraph:10',
        'user_id' => 'rand:1:10',
        'reply_id' => 'rand:50:100',
        'created_at' => 'date:timestamp',
        'updated_at' => 'date:timestamp',
    ],
];