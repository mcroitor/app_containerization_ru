<?php

include __DIR__ . "/config.php";

// load site configuration
$data = config::$DB->query("SELECT * FROM config")->fetchAll();
// file_put_contents("php://stderr", "[DEBUG] " . print_r($data, true) . "\n");
$site_config = [];
foreach ($data as $row) {
    $site_config[$row['name']] = $row['value'];
}

$q = empty($_GET['page']) ? "index" : $_GET['page'];

$page_ids = config::$DB->query("SELECT page_id FROM queries WHERE query='{$q}'")->fetchAll();

$page_id = 1;

if (!empty($page_ids)) {
    $page_id = $page_ids[0]['page_id'];
}

$page = config::$DB->query("SELECT * FROM pages WHERE id={$page_id}")->fetch();

// write $page value to stderr
//file_put_contents("file://stderr", "[DEBUG] " . print_r($page, true) . "\n");

file_put_contents("/tmp/log.txt", "Page: " . print_r($page, true) . "\n", FILE_APPEND);

$log = file_get_contents("/tmp/log.txt");

$logSize = strlen($log);

$chunks = explode("Page:", $log);

foreach ($chunks as $chunk) {
    $oops = str_replace("Page:", "[DEBUG]", $chunk);
}

// generate random number
$random = rand(10, 20);
// allocate memory for $random MB
$memory = str_repeat("x", $random * 1024 * 1024);

// pause for $random_seconds second
$random_seconds = rand(1, 5);
sleep($random_seconds);

//file_put_contents("file://stderr", "[DEBUG] log size = {$logSize}\n");

$template = file_get_contents(__DIR__ . "/templates/index.tpl");

$data = [
    "{site-name}" => $site_config['site_name'],
    "{page-title}" => $page['title'],
    "{page-content}" => $page['content'],
];

echo str_replace(array_keys($data), array_values($data), $template);