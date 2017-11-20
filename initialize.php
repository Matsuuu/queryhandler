<?php
include_once('entities.php');
include_once('dbclasses.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Initializing database \n";
echo "====================== \n \n";

global $qh;

foreach($classes as $c) {
    $class = new $c();
    $vars = $class->initialize();
    
    if(checkIfTableExists($c)) {
        updateTable($c, $vars);
        echo "Table " . $c . " updated \n";
    } else {
        createTable($c, $vars);
        echo "Table " . $c . " created \n";
    }

}

echo "\n\n All done!";

function checkIfTableExists($c) {
    global $conn;
    $dbase = $conn->query("SELECT database()")->fetchColumn();
    $query = $conn->query("SELECT * 
                                FROM information_schema.tables
                                WHERE table_schema = '".$dbase."' 
                                AND table_name = '".lcfirst($c)."'
                                LIMIT 1;")->fetchColumn();
                
    return $query;
}

function createTable($c, $vars) {
    global $conn;
    $query = "CREATE TABLE " . lcfirst($c) . "(";
        
        $i = 0;
        foreach($vars as $key => $val) {
            $query .= " " . lcfirst($key) . " " . $val;
            if($i != count($vars) - 1) {
                $query .= ",";
            } else {
                $query .= ")";
            }
            $i++;
        }
    $conn->query($query);
}

function updateTable($c, $vars) {
    global $conn;

    $oldtable = lcfirst($c);
    $columns = getColumns($oldtable);
    $copy = lcfirst($c) . "_copy";

    // Create a copy of the table
    $conn->query("CREATE TABLE " . $copy . " LIKE " . $oldtable);
    // Copy data to the temp table
    $conn->query("INSERT INTO " . $copy . " SELECT * FROM " . $oldtable);
    // Drop the old table
    $conn->query("DROP TABLE " . $oldtable);
    // Create a new table with the parameters
    createTable($c, $vars);
    $newtable = lcfirst($c);
    $columns = compareColumns($newtable, $columns);
    // Insert the data from temp to new table
    $conn->query("INSERT INTO " . $newtable . " (" . $columns . ") 
                    SELECT " . $columns . " FROM ". $copy);
    // Drop temp table
    $conn->query("DROP TABLE " . $copy);
}

function getColumns($table) {
    global $conn;
    $dbase = $conn->query("SELECT database()")->fetchColumn();
    $columns = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
                                WHERE TABLE_NAME = '" . $table . "'
                                AND TABLE_SCHEMA = '" . $dbase ."'")->fetchAll();

    $insertCols = "";
    foreach($columns as $col) {
        $insertCols .= $col[0];
        if($col !== end($columns)) $insertCols .= ', ';
    }

    return $insertCols;
}

function compareColumns($newTable, $columns) {
    global $conn;
    $newtableCols = getColumns($newTable);
    $new = explode(', ', $newtableCols);
    $old = explode(', ', $columns);
    if(count($new) < count($old)) {
        $columns = implode(', ', $new);
    }
    return $columns;
}

?>