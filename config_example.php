<?php

return   [
    'db' => [
        'dbname' => 'smexp',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ],
    'arch' => [
        'dir' => __DIR__.'/tmp'
    ],
    'files' => [
        'files' => __DIR__.'/files',
        'uploads' => __DIR__.'/files/uploads'
    ]
];