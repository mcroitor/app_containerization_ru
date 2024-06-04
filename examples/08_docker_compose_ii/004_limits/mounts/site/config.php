<?php


class config {

    private static $DB_HOST;
    private static $DB_NAME;
    private static $DB_USER;
    private static $DB_PWD;

    private static $DSN;

    public static $DB;

    public static function init() {
        date_default_timezone_set("Europe/Chisinau");
        self::$DB_HOST = getenv("MYSQL_HOST");
        self::$DB_NAME = getenv("MYSQL_DATABASE");
        self::$DB_USER = getenv("MYSQL_USER");
        self::$DB_PWD = getenv("MYSQL_PASSWORD");

        self::$DSN = "mysql:host=" . self::$DB_HOST . ";dbname=" . self::$DB_NAME;

        self::$DB = new PDO(self::$DSN, self::$DB_USER, self::$DB_PWD);
    }
};

config::init();