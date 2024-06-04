<?php
$top_level = TRUE;
session_start();

if(!file_exists('./config.php')) {
    die("site is broken: config is missing");
}
if(!file_exists('./include/common.lib.php')) {
    die("site is broken: common.lib is missing");
}
if(!file_exists('./include/page.class.php')) {
    die("site is broken: page.class is missing");
}

include './config.php';
include './include/common.lib.php';
include './include/page.class.php';

$p = new Page($cfg);

$p->genPage(filter_input(INPUT_GET, "p"));

echo $p->getHtml();
