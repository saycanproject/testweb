<?php
class DB {
    private $mysqli;

    public function __construct($host = "localhost", $username = "root", $password = "tt1201", $database = "test") {
        $this->mysqli = new mysqli($host, $username, $password, $database);
        if ($this->mysqli->connect_errno) {
            throw new Exception("Failed to connect to MySQL: " . $this->mysqli->connect_error);
        }
    }

    public function __destruct() {
        $this->mysqli->close();
    }

    public function real_escape_string($string) {
    return $this->mysqli->real_escape_string($string);
}

    public function query($sql) {
        $result = $this->mysqli->query($sql);
        if (!$result) {
            throw new Exception("Failed to execute query: " . $this->mysqli->error);
        }
        return $result;
    }

    public function fetchAll($sql) {
        $result = $this->query($sql);
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $result->free();
        return $rows;
    }

    public function fetchOne($sql) {
        $result = $this->query($sql);
        $row = $result->fetch_assoc();
        $result->free();
        return $row;
    }

    public function insert($table, $data) {
        $fields = array();
        $values = array();
        foreach ($data as $field => $value) {
            $fields[] = "`{$field}`";
            $values[] = "'" . $this->mysqli->real_escape_string($value) . "'";
        }
        $sql = "INSERT INTO `{$table}` (" . implode(", ", $fields) . ") VALUES (" . implode(", ", $values) . ")";
        $result = $this->query($sql);
        return $this->mysqli->insert_id;
    }

    public function update($table, $data, $where) {
        $sets = array();
        foreach ($data as $field => $value) {
            $sets[] = "`{$field}` = '" . $this->mysqli->real_escape_string($value) . "'";
        }
        $sql = "UPDATE `{$table}` SET " . implode(", ", $sets) . " WHERE {$where}";
        $result = $this->query($sql);
        return $this->mysqli->affected_rows;
    }

    public function delete($table, $where) {
        $sql = "DELETE FROM `{$table}` WHERE {$where}";
        $result = $this->query($sql);
        return $this->mysqli->affected_rows;
    }
}
