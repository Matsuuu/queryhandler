<?php

$pk         = "INT(11) AUTO_INCREMENT PRIMARY KEY";
$int        = "INT(11)";
$string     = "VARCHAR(255)";
$text       = "TEXT";
$longtext   = "LONGTEXT";
$timestamp  = "TIMESTAMP";
$date       = "DATE";
$datetime   = "DATETIME";
$fk         = "FOREIGN KEY";


define("PKINT", $pk);
define("Number", $int);
define("Varchar", $string);
define("Text", $text);
define("Longtext", $longtext);
define("Timestamp", $timestamp);
define("Date", $date);
define("Datetime", $datetime);
define("FK", $fk);

function createForeignKey($key, $reftable, $refcol) {
    return " INT(11), FOREIGN KEY (".$key.") REFERENCES " . $reftable . "(" . $refcol . ")";
}

?>