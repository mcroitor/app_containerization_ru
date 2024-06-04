<?php

namespace core;

use core\db\database;
use core\api\meta;

class generator
{

    private const SQLITE = "sqlite";
    private const MYSQL = "mysql";
    private const GET_TABLES = [
        self::SQLITE => "sqlite_get_tables",
        self::MYSQL => "mysql_get_tables"
    ];
    private const GET_FIELDS = [
        self::SQLITE => "PRAGMA table_info({table})",
        self::MYSQL => "DESCRIBE {table}"
    ];
    private const FIELD_NAME = [
        self::SQLITE => "name",
        self::MYSQL => "Field"
    ];

    private $db;
    private $outputdir = "." . DIRECTORY_SEPARATOR;

    public function __construct(object $options)
    {
        $this->db = new database($options);
        $db_type = $this->db->get_type();
        if (array_key_exists($db_type, self::GET_TABLES) === false) {
            exit("database '{$db_type}' is not supported");
        }
    }

    public function set_output_dir(string $output_dir)
    {
        $this->outputdir = $output_dir;
    }

    public function get_output_dir(): string
    {
        return $this->outputdir;
    }

    public function do(meta $meta)
    {
        $tables = $this->get_tables();

        // foreach table create description
        foreach ($tables as $table) {
            $fields = $this->get_fields($table);
            file_put_contents($this->outputdir . "{$table}.php", $meta->create($table, $fields));
        }
        // create include script
        $result = "<?php" . PHP_EOL . PHP_EOL;
        foreach ($tables as $table) {
            $result .= "include_once __DIR__ . '/{$table}.php';" . PHP_EOL;
        }
        file_put_contents("{$this->outputdir}_include_meta.php", $result);
    }

    private function get_tables(): array
    {
        $db_type = $this->db->get_type();
        return $this->{self::GET_TABLES[$db_type]}();
    }

    public function get_fields(string $table): array
    {
        $column_names = [];
        $db_type = $this->db->get_type();
        $query = str_replace("{table}", $table, self::GET_FIELDS[$db_type]);
        $select = $this->db->query_sql($query);
        foreach ($select as $field_description) {
            $column_names[] = $field_description[self::FIELD_NAME[$db_type]];
        }
        return $column_names;
    }

    private function sqlite_get_tables(): array
    {
        return $this->db->select_column("sqlite_master", "name", ["type" => "table"]);
    }

    private function mysql_get_tables(): array
    {
        $tmp = $this->db->query_sql("SHOW TABLES");
        $result = [];
        foreach ($tmp as $value) {
            $result[] = reset($value);
        }
        return $result;
    }
}
