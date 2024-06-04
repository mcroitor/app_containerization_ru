<?php

namespace mc\sql;

/**
 * SQL query builder.
 */
class query {
    /**
     * supported commands
     */
    public const SELECT = "SELECT";
    public const INSERT = "INSERT";
    public const UPDATE = "UPDATE";
    public const DELETE = "DELETE";

    /**
     * query configuration parameters
     */
    public const TYPE = "type";
    public const TABLE = "table";
    public const FIELDS = "fields";
    public const VALUES = "values";
    public const WHERE = "where";
    public const ORDER = "order";
    public const LIMIT = "limit";

    protected const PATTERN = [
        self::SELECT => "SELECT %fields% FROM %table%%where%%order%%limit%",
        self::INSERT => "INSERT INTO %table% (%fields%) VALUES (%values%)",
        self::UPDATE => "UPDATE %table% SET %values%%where%",
        self::DELETE => "DELETE FROM %table%%where%",
    ];

    protected string $type = "";
    protected string $table = "";
    protected array $fields = [];
    protected array $values = [];
    protected array $where = [];
    protected array $order = [];
    protected array $limit = [];

    public function __construct(array $config){
        foreach ($config as $key => $value) {
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    /**
     * return query command type
     * @return string
     */
    public function get_type(): string {
        return $this->type;
    }

    /**
     * create query for select
     * @return query
     */
    public static function select(): query{
        return new query([
            self::TYPE => self::SELECT,
        ]);
    }

    /**
     * create query for insert
     * @return query
     */
    public static function insert(): query{
        return new query([
            self::TYPE => self::INSERT,
        ]);
    }

    /**
     * create query for update
     * @return query
     */
    public static function update(): query{
        return new query([
            self::TYPE => self::UPDATE,
        ]);
    }

    /**
     * create query for delete
     * @return query
     */
    public static function delete(): query{
        return new query([
            self::TYPE => self::DELETE,
        ]);
    }

    /**
     * clone a query
     * @return query
     */
    public function clone(): query {
        return new query([
            self::TYPE => $this->type,
            self::TABLE => $this->table,
            self::FIELDS => $this->fields,
            self::VALUES => $this->values,
            self::WHERE => $this->where,
            self::ORDER => $this->order,
            self::LIMIT => $this->limit,
        ]);
    }

    /**
     * set fields and return new query
     * @param array $fields
     * @return query
     */
    public function fields(array $fields): query {
        $result = $this->clone();
        $result->fields = $fields;
        return $result;
    }

    /**
     * set values and return new query
     * @param array $values
     * @return query
     */
    public function values(array $values): query {
        $result = $this->clone();
        $result->values = $values;
        return $result;
    }

    /**
     * set where conditions and return new query
     * @param array $where
     * @return query
     */
    public function where(array $where): query {
        $result = $this->clone();
        $result->where = $where;
        return $result;
    }

    /**
     * set order conditions and return new query
     * @param array $order
     * @return query
     */
    public function order(array $order): query {
        $result = $this->clone();
        $result->order = $order;
        return $result;
    }

    /**
     * set limit conditions and return new query
     * @param array $limit
     * @return query
     */
    public function limit(int $limit, int $offset = 0): query {
        $result = $this->clone();
        $result->limit = [
            'offset' => $offset,
            'limit' => $limit,
        ];
        return $result;
    }

    /**
     * set table and return new query
     * @param string $table
     * @return query
     */
    public function table(string $table): query {
        $result = $this->clone();
        $result->table = $table;
        return $result;
    }

    /**
     * return query string
     * @return string
     */
    public function build(): string {
        $replace = [
            "%table%" => $this->table,
            "%fields%" => $this->build_fields(),
            "%values%" => $this->build_values(),
            "%where%" => $this->build_where(),
            "%order%" => $this->build_order(),
            "%limit%" => $this->build_limit(),
        ];
        return \trim(\strtr(self::PATTERN[$this->type], $replace));
    }

    /**
     * return fields string
     * @return string
     */
    protected function build_fields(): string {
        if(empty($this->fields)){
            return "*";
        }
        return \implode(", ", $this->fields);
    }

    /**
     * return values string
     * @return string
     */
    protected function build_values(): string {
        if(empty($this->values)){
            return "";
        }
        // TODO: quote values!
        return \implode(", ", $this->values);
    }

    /**
     * return where string
     * @return string
     */
    protected function build_where(): string {
        if(empty($this->where)){
            return "";
        }
        $tmp = [];
        foreach ($this->where as $key => $value) {
            // TODO: quote values!
            $tmp[] = "{$key}='{$value}'";
        }
        return " WHERE " . \implode(" AND ", $tmp);
    }

    /**
     * return order string
     * @return string
     */
    protected function build_order(): string {
        if(empty($this->order)){
            return "";
        }
        $tmp = [];
        foreach ($this->order as $key => $value) {
            $tmp[] = "{$key} {$value}";
        }
        return " ORDER BY " . \implode(", ", $tmp);
    }

    /**
     * return limit string
     * @return string
     */
    protected function build_limit(): string {
        if(!$this->limit){
            return "";
        }
        $tmp = [];
        $tmp[] = "LIMIT " . $this->limit["limit"];
        if(isset($this->limit["offset"])){
            $tmp[] = "OFFSET " . $this->limit["offset"];
        }
        return " " . \implode(" ", $tmp);
    }

    /**
     * convert query object to string
     * @return string
     */
    public function __toString() {
        return $this->build();
    }
}