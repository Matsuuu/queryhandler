<?php

class DataTypes {

    function foreignKey($key, $reftable, $refcol) {
        return " INT(11), FOREIGN KEY (".$key.") REFERENCES " . $reftable . "(" . $refcol . ")";
    }

    

    // Static types
    public $pk           = "INT(11) AUTO_INCREMENT PRIMARY KEY";

    // Text types
    public $tinytext     = "TINYTEXT";
    public $text         = "TEXT";
    public $mediumText   = "MEDIUMTEXT";
    public $longText     = "LONGTEXT";


    function char($num) {
        if($num < 0 || $num > 255) die("CHAR number out of range");
        else return "CHAR(" . $num . ")";
    }

    function varChar($num) {
        if($num < 0 || $num > 255) die("VARCHAR number out of range");
        else return "VARCHAR(" . $num . ")";
    }



    // Numeric types

    function int($num) {
        if($num < 0 || $num > 11) die("INT number out of range");
        else return "INT(".$num.")";
    }

    function tinyInt($num) { return "TINYINT(".$num.")"; }

    function mediumInt($num) { return "MEDIUMINT(".$num.")"; }

    function bigInt($num) { return "BIGINT(".$num.")"; }

    function float($num, $d) { return "FLOAT(".$num.",".$d.")"; }

    function double($num, $d) { return "DOUBLE(".$num.",".$d.")"; }

    function decimal($num, $d) { return "DECIMAL(".$num.",".$d.")"; }



    // Blob types
    public $blob         = "BLOB";
    public $mediumBlob   = "MEDIUMBLOB";
    public $longBlob     = "LONGBLOB";

    // Time types
    public $timeStamp    = "TIMESTAMP";
    public $date         = "DATE";
    public $dateTime     = "DATETIME";
    public $time         = "TIME";
    public $year         = "YEAR";




}
?>