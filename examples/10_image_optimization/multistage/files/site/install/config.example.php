<?php

class config
{
    public const root_dir = __DIR__;
    public const module_dir = self::root_dir . "/module/";
    public const core_dir = self::root_dir . "/core/";

    public const dsn = "sqlite:" . self::root_dir . "/databasename.db";

    public const core = [
        "database/mc/crud",
        "database/mc/database",
        "database/mc/query",
        "logger/mc/logger",
        "router/mc/route",
        "router/mc/router",
        "template/mc/template",
    ];

    public static $debug = true;
    public static $debugfile = "php://stdout";
    public static $errorlogfile = "error.log";

    public static function loadCore()
    {
        foreach (self::core as $class_name) {
            include_once self::core_dir . "{$class_name}.php";
        }
    }

    public static function load(string $dir, string $type = "")
    {
        $filenames = scandir($dir);
        if ($type !== "") {
            $type = ".{$type}";
        }
        foreach ($filenames as $filename) {
            if (is_file("{$dir}{$filename}") && strstr($filename, $type)) {
                include_once "{$dir}{$filename}";
            }
        }
    }
}

\config::loadCore();
\config::load(\config::core_dir, "interface");
\config::load(\config::core_dir, "class");
