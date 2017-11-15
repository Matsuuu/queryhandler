<?php

class QueryHandler {

    private $conn;
    public $table;
    public $cols;

    function __construct($conn) {
        $this->conn = $conn;
        $this->dbase = $this->conn->query("SELECT database()")->fetchColumn();
    }

    function setTable($tablename) {
        try {
            $query = $this->conn->query("SELECT * 
                                FROM information_schema.tables
                                WHERE table_schema = '".$this->dbase."' 
                                    AND table_name = '".$tablename."'
                                LIMIT 1;")->fetchColumn();
                                
            if($query == FALSE) {
                die("Table with the name " . $tablename . " was not found");
            }

        } catch (Error $e) {
            die("Table with the name " . $tablename . " was not found");
        }
        $this->table = $tablename;

        $cols = [];
        foreach($this->conn->query("SHOW COLUMNS FROM " . $tablename, PDO::FETCH_ASSOC) as $col) {
            if($col['Field'] != "ID") array_push($cols, "`" . $col['Field'] . "`");
        }
        
        $this->cols = $cols;
        return $this;
    }

    public function getAll() {
        $entities = $this->conn->query("SELECT * FROM " . $this->table, PDO::FETCH_ASSOC);
        if($entities == FALSE) die("Table not found");
        return $entities;
    }

    public function deleteEntity($id) {
        $entities = $this->conn->execute("DELETE FROM " . $this->table . " WHERE ID = " . $id);
    }

    public function addEntity() {
        if($this->table == null) {

        }
        if(count(func_get_args()) != count($this->cols)); die("Column count did not match. Table " . $this->table . " columns are: " . implode(', ', $this->cols) . ". You entered: " . implode(',',func_get_args()));
        $args = implode(", ", func_get_args());
        $cols = implode(", ", $this->cols);
        $query = $this->conn->prepare("INSERT INTO " . $this->table . " (" . $cols . ") VALUES (" . $args . ")");
        try {
            $query->execute();
        } catch(PDOException $e) {
            die("Something went wrong. " . $e->getMessage());
        }
        return $args . " Successfully added into the table " . $this->table . ".";
    }

}

?>