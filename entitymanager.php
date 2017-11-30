<?php
global $storedQueries;
$storedQueries = [];

// POST functions

    function addEntity($post) {
        global $qh;
        global $tablename;

        unset($post["function"]);

        $params = [];
        foreach($post as $param) {
            array_push($params, $param);
        }

        $qh->setTable($tablename)->addEntity($params);
    }

    function deleteEntity($post) {
        global $qh;
        global $tablename;
        unset($post['function']);
        $qh->setTable($tablename)->deleteEntity(current($post));
    }

    function set($col, $val) {
        global $qh;
        global $tablename;

        $this->$col = $val;

        // TODO: Prepare a statement by dynamic values which you insert into stored queries for execution
    }

?>