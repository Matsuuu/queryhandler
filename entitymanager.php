<?php
global $storedQueries;
$storedQueries = [];

// POST functions

    function addEntity($tablename, $post) {
        global $qh;

        unset($post["function"]);

        $params = [];
        foreach($post as $param) {
            array_push($params, $param);
        }

        $qh->setTable($tablename)->addEntity($params);
    }

    function deleteEntity($tablename, $post) {
        global $qh;
        unset($post['function']);
        $qh->setTable($tablename)->deleteEntity(current($post));
    }

    function getEntityValue($user, $tablename, $col) {
        global $conn;

        return $conn->query("SELECT " . $col . " FROM " . $tablename . " WHERE id = " . $user->id, PDO::FETCH_ASSOC)->fetchColumn();
    }

?>