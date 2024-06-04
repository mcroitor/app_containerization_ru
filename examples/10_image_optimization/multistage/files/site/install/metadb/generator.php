<?php

include_once __DIR__ . "/config.php";

$short_options = ""; /// "d:u::p::";

function usage()
{
    echo "usage: php " . str_replace(__DIR__, "", __FILE__)
        . " --dsn=<DSN> [--user=<USER> --password=<PASSWORD>] [--output=<OUTPUT_DIR>]" . PHP_EOL;
    echo "\t\t dsn - connection string" . PHP_EOL;
    echo "\t\t user - db user, used for MySQL, for example" . PHP_EOL;
    echo "\t\t password - password for db user" . PHP_EOL;
    echo "\t\t output - path to outpot, implicitly `./output/`" . PHP_EOL;
}

$long_options = [
    "dsn:",
    "user::",
    "password::",
    "output::",
];

$options = getopt($short_options, $long_options);

if (empty($options)) {
    usage();
    exit();
}

if (empty($options["dsn"])) {
    exit("dsn string is not specified, exit.");
}

$config = (object) [
    "dsn" => $options["dsn"],
    "user" => $options["user"] ?? null,
    "password" => $options["password"] ?? null,
];

echo create_meta_info($config, $options["output"] ?? __DIR__ . "/output/");
