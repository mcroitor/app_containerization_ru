<?php

require_once __DIR__ . '/modules/database.php';
require_once __DIR__ . '/modules/page.php';

require_once __DIR__ . '/config.php';

$dsn = "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset=utf8";

$db = new Database($dsn, $config['db']['username'], $config['db']['password']);

$page = new Page(__DIR__ . '/templates/index.tpl');

$id = $_GET['id'] ?? 1;

// bad idea, not recommended
$sql = "SELECT * FROM page WHERE id='{$id}' LIMIT 1";

$data = $db->Fetch($sql);

$data = $data[0];

$data['site-name'] = $config['site']['name'];

echo $page->render($data);
