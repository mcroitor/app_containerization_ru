<?php

require_once __DIR__ . '/modules/database.php';
require_once __DIR__ . '/modules/page.php';

require_once __DIR__ . '/config.php';

$db = new Database($config['db']['path']);

$page = new Page(__DIR__ . '/templates/index.tpl');

$path = $_GET['path'];

// bad idea, not recommended
$sql = "SELECT * FROM page WHERE path='{$path}' LIMIT 1";

$data = $db->fetch($sql);

$data['site-name'] = $config['site']['name'];

echo $page->render($data);
