<?php
require_once(__DIR__.'/../dbclasses.php');
include(__DIR__.'/../datatypes.php');

$tablename = 'template';
$qh = new QueryHandler($conn);
class User {

    protected $id       = PKINT;

    function initialize() { 
        return get_object_vars($this);
    }

    function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

}

if($_POST) {
    $_POST['function']($_POST);   
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}


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

?>