<?php

$db_host = getenv('MYSQL_HOST');
$db_name = getenv('MYSQL_DATABASE');
$db_user = getenv('MYSQL_USER');
$db_password = getenv('MYSQL_PASSWORD');

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

$mysqli->set_charset("utf8");
