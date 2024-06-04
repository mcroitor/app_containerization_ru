<?php

// write access log to the ./logs/access.log
file_put_contents(__DIR__ . "/logs/access.log", date("Y-m-d H:i:s") .
        " " . $_SERVER["REMOTE_ADDR"] . " " . $_SERVER["REQUEST_URI"] . PHP_EOL, FILE_APPEND);

$replace = [
    "{content}" => "<h1>Hello, World!</h1>",
];

$page = file_get_contents(__DIR__ . "/templates/index.tpl");

echo str_replace(array_keys($replace), array_values($replace), $page);