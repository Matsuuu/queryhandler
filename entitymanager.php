<?php

// POST functions

    function addEntity($post) {
        global $qh;
        global $tablename;

        unset($post["function"]);

        $params = [];
        foreach($post as $param) {
            array_push($params, $param);
        }
        echo $tablename;

        $qh->setTable($tablename)->addEntity($params);
    }

    function deleteEntity($post) {
        global $qh;
        global $tablename;
        unset($post['function']);
        $qh->setTable($tablename)->deleteEntity(current($post));
    }



?>