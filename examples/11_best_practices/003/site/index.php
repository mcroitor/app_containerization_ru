<a href="./?id=1">First</a> <a href="./?id=2">Second</a>
<?php

include_once('config.php');

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$q = "SELECT news_title, news_body FROM news WHERE news_id={$id} LIMIT 1";
$html = "";

$result = $mysqli->query($q) or die($mysqli->error);

while($row = $result->fetch_assoc()){
	$html .= "<article><h2>{$row['news_title']}</h2><p>{$row['news_body']}</p></article>";
}

echo $html;