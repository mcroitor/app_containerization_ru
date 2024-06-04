<?php

$site_name = "My Site";

$queries = [
    "index" => [
        "title" => "Home",
        "content" => "Welcome to my site!",
    ],
    "about" => [
        "title" => "About",
        "content" => "This is a site about my site.",
    ],
    "404" => [
        "title" => "404",
        "content" => "Page not found.",
    ],
];

$page = empty($_GET['page']) ? 
    "index" : (
        isset($queries[$_GET['page']]) ? $_GET['page'] : "404"
    );



// write $page value to stderr
// define('STDERR', fopen('php://stderr', 'w'));
file_put_contents("php://stderr", "Page: {$page}\n");

$template = file_get_contents(__DIR__ . "/templates/index.tpl");

$data = [
    "{site-name}" => $site_name,
    "{page-title}" => $queries[$page]['title'],
    "{page-content}" => $queries[$page]['content'],
];

echo str_replace(array_keys($data), array_values($data), $template);