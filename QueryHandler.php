<?php
include_once('dbclasses.php');
include_once('entities.php');

class QueryHandler {

    private $conn;
    public $table;
    public $colnames;
    public $cols;

    function __construct($conn) {
        $this->conn = $conn;
        $this->dbase = $this->conn->query("SELECT database()")->fetchColumn();
    }

    function checkTable() {
        return ($this->table !== null) ? false : true;
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
        $colnames = [];
        foreach($this->conn->query("SHOW COLUMNS FROM " . $tablename, PDO::FETCH_ASSOC) as $col) {
            if($col['Field'] != "ID" && $col['Field'] != "id") array_push($cols, "`" . $col['Field'] . "`");
            array_push($colnames, $col['Field']);
        }
        
        $this->cols = $cols;
        $this->colnames = $colnames;

        return $this;
    }

    private function unsetTable() {
        $this->table = null;
    }

    public function getAll() {
        $entities = $this->conn->query("SELECT * FROM " . $this->table, PDO::FETCH_ASSOC);
        if($entities == FALSE) die("Table not found");

        $this->unsetTable();
        return $entities;
    }

    public function findBy($col, $val) {
        if($this->checkTable()) die("Table not selected");
        if(in_array($col, $this->colnames)) {
            $query = "SELECT * FROM " .$this->table. " WHERE `". $col."` = '". $val . "'";
            $results = $this->conn->query($query, PDO::FETCH_ASSOC);
        } else {
            die("Column with the name " . $col . " not found in table ". $this->table);
        }
        if($results->rowCount() == 0) echo "No results found with search";
        return $results;
    }

    public function deleteEntity($id) {
        if($this->checkTable()) die("Table not selected");
        $entities = $this->conn->query("DELETE FROM " . $this->table . " WHERE ID = " . $id);
        $this->unsetTable();
    }

    public function addEntity() {
        if($this->checkTable()) {
            die("No table selected.");
        }

        if(count(func_get_args()) != count($this->cols)) die("Column count did not match. Table " . $this->table . " columns are: " . implode(', ', $this->cols) . ". You entered: " . implode(',',func_get_args()));
        $args = implode(", ", func_get_args());
        $cols = implode(", ", $this->cols);

        $insertValArr = $this->cols;
        foreach($insertValArr as &$val) {
            $val = str_replace('`', '', $val);
            $val = ':' . $val;
        }
        $insertVals = implode(', ', $insertValArr);

        $query = $this->conn->prepare("INSERT INTO " . $this->table . " (" . $cols . ") VALUES (" . $insertVals . ")");

        try {
            $execQuery = [];
            $argarr = func_get_args();
            foreach($insertValArr as $val) {
                $execQuery[$val] = current($argarr);
                next($argarr);
            }
            $query->execute($execQuery);
        } catch(PDOException $e) {
            die("Something went wrong. " . $e->getMessage());
        }
        echo $args . " Successfully added into the table " . $this->table . ".";
        $this->unsetTable();
    }


}

?>