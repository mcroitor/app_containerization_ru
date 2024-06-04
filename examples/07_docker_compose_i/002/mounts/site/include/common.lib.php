<?php

define("LOG_PATH", "./logs/");
define("THEME_PATH", "./themes/");
define("MODULE_PATH", "./modules/");
define("DEBUG", "0");

function writeLog($data, $log_name = "default.log") {
    if (isset($_SESSION["timezone"])) {
        date_default_timezone_set($_SESSION["timezone"]);
    }
    $str = date("Y-m-d H:i:s") . "\t: {$data}\n";
    $log = fopen(LOG_PATH . $log_name, "a");
    fwrite($log, $str);
    fclose($log);
}

function includeFile($file_name, $multiplicity = false) {
    if (!file_exists($file_name)) {
        $error = "error 01: '{$file_name}' not exists";
        writeLog($error, "errors.log");
        exit($error);
    }

    if (DEBUG == "1") {
        writeLog("included {$file_name} file");
    }
    if ($multiplicity == true) {
        include $file_name;
    } else {
        include_once $file_name;
    }
}

function loadData($file_name) {
    if (!file_exists($file_name)) {
        $error = "error 01: '{$file_name}' not exists";
        writeLog($error, "errors.log");
        exit($error);
    }
    $result = file_get_contents($file_name);
    return $result;
}

function sqlQuery($query, $error = "Error: ", $need_fetch = true) {
    global $dblink;
    writeLog($query);

    $array = array();
    $result = $dblink->query($query);
    if (!$result) {
        $aux = "$error $query, " . $dblink->error;

        if (DEBUG == "1") {
            writeLog($aux);
        }

        writeLog($aux, "errors.log");
        exit($dblink->error);
    }

    if ($need_fetch) {
        while ($fetch = $result->fetch_array()) {
            $array[] = $fetch;
        }
    }
    return $array;
}

function _style($style_name, $path) {
    $style_name = str_replace(".css", "", $style_name);
    return "<link rel='stylesheet' href='{$path}{$style_name}.css' />";
}

function _script($script_name, $path, $type = 'javascript') {
    $script_name = str_replace(".js", "", $script_name);
    return "<script type='text/{$type}' src='{$path}{$script_name}.js'></script>";
}

function _link($link, $url = "#", $style = 'link'){
    return "<a href='$url' class='$style'>$link</a>";
}