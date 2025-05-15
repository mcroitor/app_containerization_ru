<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'index.html';

echo file_get_contents("{$page}");