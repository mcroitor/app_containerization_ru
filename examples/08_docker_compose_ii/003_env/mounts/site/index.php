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
file_put_contents("php://stderr", "Page: " . print_r($page, true) . "\n");

$template = file_get_contents(__DIR__ . "/templates/index.tpl");

$data = [
    "{site-name}" => $site_config['site_name'],
    "{page-title}" => $page['title'],
    "{page-content}" => $page['content'],
];

echo str_replace(array_keys($data), array_values($data), $template);