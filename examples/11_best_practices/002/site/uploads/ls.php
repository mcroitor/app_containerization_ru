<?php

$path = isset($_GET["path"]) ? $_GET["path"] : ".";

// Open a known directory, and proceed to read its contents
if (is_dir($path)) {
    if ($dh = opendir($path)) {
        while (($file = readdir($dh)) !== false) {
            echo "filename: $file : filetype: " . filetype("./" . $file) . "\n";
        }
        closedir($dh);
    }
}
exit();