<?php

/**
 * Wrapper for PDO Sqlite database
 */
class Database {
    private $db;

    public function __construct(string $path) {
        $this->db = new PDO("sqlite:$path");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function Execute(string $sql): void {
        $this->db->exec($sql);
    }

    public function Fetch(string $sql): array {
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Create(string $table, array $data): void {
        $fields = implode(', ', array_keys($data));
        $values = implode("', '", array_values($data));
        $sql = "INSERT INTO {$table} ({$fields}) VALUES ('{$values}')";
        $this->Execute($sql);
    }

    public function Read(string $table, string $id): array {
        $sql = "SELECT * FROM {$table} WHERE id = '{$id}' LIMIT 1";
        return $this->Fetch($sql);
    }

    public function Update(string $table, string $id, array $data): void {
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "{$key} = '{$value}'";
        }
        $fields = implode(', ', $fields);
        $sql = "UPDATE {$table} SET {$fields} WHERE id = '{$id}'";
        $this->Execute($sql);
    }

    public function Delete(string $table, string $id): void {
        $sql = "DELETE FROM {$table} WHERE id = '{$id}'";
        $this->Execute($sql);
    }

    public function Count(string $table): int {
        $sql = "SELECT COUNT(*) AS cnt FROM {$table}";
        $data = $this->Fetch($sql);
        return (int) $data[0]['cnt'];
    }
}
