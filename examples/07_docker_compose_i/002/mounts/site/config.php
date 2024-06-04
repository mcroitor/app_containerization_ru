<?php

$cfg = array();
$cfg['dbhost'] = "database";
$cfg['dbname'] = "example_cms_db";
$cfg['dbuser'] = "user";
$cfg['dbpwd'] = "password";

date_default_timezone_set("Europe/London");
$dblink = new mysqli($cfg["dbhost"], $cfg["dbuser"], $cfg["dbpwd"], $cfg["dbname"]);

