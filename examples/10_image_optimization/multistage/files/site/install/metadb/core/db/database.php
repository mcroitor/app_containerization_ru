<?php

namespace core\db;

/**
 * PDO wrapper
 *
 * @author Croitor Mihail <mcroitor@gmail.com>
 */
class database
{

    //put your code here
    private $pdo;

    public const ALL = ["*"];
    public const LIMIT1 = ["from" => 0, "total" => 1];

    public function __construct(object $options)
    {
        try {
            $this->pdo = new \PDO($options->dsn, $options->user ?? null, $options->password ?? null);
        } catch (\Exception $ex) {
            $obj = json_encode($options);
            die('DB init Error: ' . $ex->getMessage() . "DSN = {$obj}");
        }
    }

    public function get_type(): string
    {
        return $this->pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);
    }

    /**
     * Common query method
     * @global string $site
     * @param string $query
     * @param string $error
     * @param bool $need_fetch
     * @return array
     */
    public function query_sql(string $query, string $error = "Error: ", bool $need_fetch = true): array
    {
        $array = array();
        $result = $this->pdo->query($query);
        if ($result === false) {
            $aux = "{$error} {$query}: "
                . $this->pdo->errorInfo()[0]
                . " : "
                . $this->pdo->errorInfo()[1]
                . ", message = "
                . $this->pdo->errorInfo()[2];
            exit($aux);
        }
        if ($need_fetch) {
            $array = $result->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $array;
    }

    /**
     * Method for dump parsing and execution
     * @param string $dump
     */
    public function parse_sqldump(string $dump)
    {
        if (\file_exists($dump)) {
            $sql = \str_replace(["\n\r", "\r\n", "\n\n"], "\n", file_get_contents($dump));
            $queries = \explode(";", $sql);
            foreach ($queries as $query) {
                $query = $this->strip_sqlcomment(trim($query));
                if ($query != '') {
                    $this->query_sql($query, "parse error:", false);
                }
            }
        }
    }

    /**
     * Method that removes SQL comments, used for dump execution.
     * @param string $string
     * @return string
     */
    private function strip_sqlcomment(string $string = ''): string
    {
        $RXSQLComments = '@(--[^\r\n]*)|(/\*[\w\W]*?(?=\*/)\*/)@ms';
        return (empty($string) ? '' : \preg_replace($RXSQLComments, '', $string));
    }

    /**
     * Simplified selection.
     * @param string $table
     * @param array $data enumerate columns for selection. Sample: ['id', 'name'].
     * @param array $where associative conditions.
     * @param array $limit definition sample: ['from' => '0', 'total' => '100'].
     * @return array
     */
    public function select(string $table, array $data = ['*'], array $where = [], array $limit = []): array
    {
        $fields = \implode(", ", $data);

        $query = "SELECT {$fields} FROM {$table}";
        if (!empty($where)) {
            $tmp = [];
            foreach ($where as $key => $value) {
                $tmp[] = "{$key}='{$value}'";
            }
            $query .= " WHERE " . \implode(" AND ", $tmp);
        }
        if (!empty($limit)) {
            $query .= " LIMIT {$limit['from']}, {$limit['total']}";
        }

        return $this->query_sql($query);
    }

    public function select_column(string $table, string $column_name, array $where = [], array $limit = []): array
    {
        $tmp = $this->select($table, [$column_name], $where, $limit);
        $result = [];
        foreach ($tmp as $value) {
            $result[] = $value[$column_name];
        }
        return $result;
    }

    /**
     * Delete rows from table <b>$table</b>. Condition is required.
     * @param string $table
     * @param array $conditions
     * @return array
     */
    public function delete(string $table, array $conditions): array
    {
        $tmp = [];
        foreach ($conditions as $key => $value) {
            $tmp[] = "{$key}={$value}";
        }
        $query = "DELETE FROM {$table} WHERE " . \implode(" AND ", $tmp);
        return $this->query_sql($query, "Error: ", false);
    }

    /**
     * Update fields <b>$values</b> in table <b>$table</b>. <b>$values</b> and
     * <b>$conditions</b> are required.
     * @param string $table
     * @param array $values
     * @param array $conditions
     * @return array
     */
    public function update(string $table, array $values, array $conditions): array
    {
        $tmp1 = [];
        foreach ($conditions as $key => $value) {
            $tmp1[] = "{$key}='{$value}'";
        }
        $tmp2 = [];
        foreach ($values as $key => $value) {
            $tmp2[] = "{$key}='{$value}'";
        }

        $query = "UPDATE {$table} SET " . \implode(", ", $tmp2) . " WHERE " . implode(" AND ", $tmp1);
        return $this->query_sql($query, "Error: ", false);
    }

    public function insert(string $table, array $values): void
    {
        $columns = \implode(", ", array_keys($values));
        $data = '"' . \implode('",  "', array_values($values)) . '"';
        $query = "INSERT INTO {$table} ($columns) VALUES ({$data})";
        $this->query_sql($query, "Error: ", false);
    }

    /**
     * Check if exists row with value(s) in table.
     * @param string $table
     * @param array $where
     * @return bool
     */
    public function exists(string $table, array $where): bool
    {
        $result = $this->select($table, ["count(*) as count"], $where);
        return $result[0]["count"] > 0;
    }

    public function get_tables(): array
    {
        $result = [];
        return $result;
    }
}
