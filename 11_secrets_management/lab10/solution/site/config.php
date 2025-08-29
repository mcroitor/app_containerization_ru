<?php

$config = [
    'db' => [
        'host' => getenv('MYSQL_HOST'),
        'name' => getenv('MYSQL_DATABASE'),
        'username' => file_get_contents('/run/secrets/user'),
        'password' => file_get_contents('/run/secrets/secret'),
    ],
    'site' => [
        'name' => 'My site',
        'description' => 'My site description',
    ],
];
