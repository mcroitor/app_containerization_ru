<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'default.php';

include $page; // . "php";
?>
<nav>
<a href="./?page=default.php">Default</a> <a href="./?page=about.php">About</a>
</nav>
<h2>Example 01a: try to hack me!</h2>