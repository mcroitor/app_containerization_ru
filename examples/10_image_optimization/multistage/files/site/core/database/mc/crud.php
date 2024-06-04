<?php

namespace mc\sql;

use \mc\sql\database;

/**
 * Simple CRUD implementation
 */
class crud
{
    private $_db;
    private $_table;
    private $_key;

    /**
     * crud constructor, must be passed a database object and a table name
     * the key is the primary key of the table, defaults to 'id' 
     * @param database $db
     * @param string $table
     * @param string $key
     */
    public function __construct(database $db, string $table, $key = "id")
    {
        $this->_db = $db;
        $this->_table = $table;
        $this->_key = $key;
    }

    /**
     * insert a new record. Returns the id of the new record
     *
     * @param array|object $data
     */
    public function insert($data)
    {
        $data = (array)$data;
        return $this->_db->insert($this->table(), $data);
    }

    /**
     * select a record by id / key
     *
     * @param int|string $id
     * @return array
     */
    public function select($id)
    {
        $result = $this->_db->select($this->table(), ["*"], [$this->key() => $id], database::LIMIT1);
        if (count($result) === 0) {
            return [];
        }
        return $result[0];
    }

    /**
     * select <b>$limit</b> records from <b>$offset</b> record.
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function all($offset = 0, $limit = 100)
    {
        return $this->_db->select($this->table(), ["*"], [], ["offset" => $offset, "limit" => $limit]);
    }

    /**
     * update a record by id / key
     * parameter <b>$data</b> must include the key
     *
     * @param array|object $data
     */
    public function update($data)
    {
        $data = (array)$data;
        $this->_db->update($this->table(), $data, [$this->key() => $data[$this->key()]]);
    }

    /**
     * if $data object contains key property, table will be
     * updated, otherwise new line will be inserted.
     *
     * @param $data
     */
    public function insert_or_update($data)
    {
        /// no key - insert object
        if (empty($data[$this->_key])) {
            $this->insert($data);
        }

        $key = $data[$this->_key];
        echo "[debug] key found " . $key . PHP_EOL;
        $result = $this->select($key);
        /// object not found, insert object
        if (empty($result)) {
            $this->insert($data);
        }

        /// update object
        $this->update($data);
    }

    /**
     * delete a record by id / key
     * 
     * @param int|string $id
     */
    public function delete($id)
    {
        $this->_db->delete($this->table(), [$this->key() => $id]);
    }

    /**
     * return the table name, userd for all CRUD operations
     * 
     * @return string
     */
    public function table()
    {
        return $this->_table;
    }

    /**
     * return the key name, userd for all CRUD operations
     * 
     * @return string
     */
    public function key()
    {
        return $this->_key;
    }

    /**
     * return number of lines in the associated table
     * 
     * @return int
     */
    public function count()
    {
        $result = $this->_db->select($this->table(), ["count(*) as count"]);
        return $result[0]["count"];
    }
}
