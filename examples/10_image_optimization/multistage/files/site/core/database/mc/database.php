<?php

namespace mc\sql;

use mc\sql\query;

/**
 * PDO wrapper
 *
 * @author Croitor Mihail <mcroitor@gmail.com>
 */
class database {

    public const LIMIT1 = [
        'limit' => 1,
        'offset' => 0
    ];
    public const LIMIT10 = [
        'limit' => 10,
        'offset' => 0
    ];
    public const LIMIT20 = [
        'limit' => 20,
        'offset' => 0
    ];
    public const LIMIT100 = [
        'limit' => 100,
        'offset' => 0
    ];

    public const ALL = ["*"];

    private $pdo;

    public function __construct(string $dsn, ?string $login = null, ?string $password = null) {
        try {
            $this->pdo = new \PDO($dsn, $login, $password);
        } catch (\Exception $ex) {
            die("DB init Error: " . $ex->getMessage() . "DSN = {$dsn}");
        }
    }

    /**
     * Close connection. After this queries are invalid and object recreating is obligatory.
     */
    public function close() {
        $this->pdo = null;
    }

    /**
     * Common query method
     * @global string $site
     * @param string $query
     * @param string $error
     * @param bool $need_fetch
     * @return array
     */
    public function query_sql(string $query, string $error = "Error: ", bool $need_fetch = true): array {
        $array = array();
        try {
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
        } catch (\PDOException $ex) {
            exit ($ex->getMessage() . ", query: " . $query);
        }
        return $array;
    }

    /**
     * Method for dump parsing and execution
     * @param string $dump
     */
    public function parse_sqldump(string $dump) {
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
    private function strip_sqlcomment(string $string = ''): string {
        $RXSQLComments = '@(--[^\r\n]*)|(/\*[\w\W]*?(?=\*/)\*/)@ms';
        return (empty($string) ? '' : \preg_replace($RXSQLComments, '', $string));
    }

    /**
     * Simplified selection.
     * @param string $table
     * @param array $data enumerate columns for selection. Sample: ['id', 'name'].
     * @param array $where associative conditions.
     * @param array $limit definition sample: ['offset' => '1', 'limit' => '100'].
     * @return array
     */
    public function select(string $table, array $data = ['*'], array $where = [], array $limit = []): array {
        $fields = \implode(", ", $data);

        $query = "SELECT {$fields} FROM {$table}";
        if (!empty($where)) {
            $tmp = [];
            foreach ($where as $key => $value) {
                $value = $this->pdo->quote($value);
                $tmp[] = "{$key}=$value";
            }
            $query .= " WHERE " . \implode(" AND ", $tmp);
        }
        if (!empty($limit)) {
            $query .= " LIMIT {$limit['offset']}, {$limit['limit']}";
        }

        return $this->query_sql($query);
    }

    /**
     * select column from table
     * @param string $table
     * @param string $column_name column name for selection.
     * @param array $where associative conditions.
     * @param string $limit definition sample: ['offset' => '1', 'limit' => '100'].
     */
    public function select_column(string $table, string $column_name, array $where = [], array $limit = []): array {
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
    public function delete(string $table, array $conditions): array {
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
    public function update(string $table, array $values, array $conditions): array {
        $tmp1 = [];
        foreach ($conditions as $key => $value) {
            $value = $this->pdo->quote($value);
            $tmp1[] = "{$key}={$value}";
        }
        $tmp2 = [];
        foreach ($values as $key => $value) {
            $value = $this->pdo->quote($value);
            $tmp2[] = "{$key}={$value}";
        }

        $query = "UPDATE {$table} SET " . \implode(", ", $tmp2) . " WHERE " . implode(" AND ", $tmp1);
        return $this->query_sql($query, "Error: ", false);
    }

    /**
     * insert values in table, returns id of inserted data.
     * @param string $table
     * @param array $values
     * @return string|false
     */
    public function insert(string $table, array $values): string|false {
        $columns = \implode(", ", \array_keys($values));
        // quoting values
        $quoted_values = \array_values($values);
        foreach ($quoted_values as $key => $value) {
            $quoted_values[$key] = $this->pdo->quote($value);
        }
        $data = \implode(",  ", $quoted_values);
        $query = "INSERT INTO {$table} ($columns) VALUES ({$data})";
        $this->query_sql($query, "Error: ", false);
        return $this->pdo->lastInsertId();
    }

    /**
     * Check if exists row with value(s) in table.
     * @param string $table
     * @param array $where
     * @return bool
     */
    public function exists(string $table, array $where): bool {
        $result = $this->select($table, ["count(*) as count"], $where);
        return count($result) > 0 && $result[0]["count"] > 0;
    }

    /**
     * Select unique values from column.
     * @param string $table
     * @param string $column
     */
    public function unique_values(string $table, string $column): array {
        return $this->query_sql("SELECT {$column} FROM {$table} GROUP BY {$column}");
    }
    
    /**
     * Execute a query object.
     * @param query $query
     * @return array
     */
    public function exec(query $query): array {
        return $this->query_sql($query->build(), "Error: ", $query->get_type() === query::SELECT);
    }
}
