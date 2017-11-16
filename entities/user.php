<?php
require(__DIR__.'/../dbinit.php');
require_once(__DIR__.'/../QueryHandler.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);


$tablename = 'users';
$qh = new QueryHandler($conn);
class User {
    private $id;
    protected $name;

    function __construct($name) {
        global $tablename;
        global $qh;

        $this->name = $name;

        $qh->setTable($tablename)->addEntity($name);
    }    

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;

        return $this;
    }
}

if($_POST) {
    $_POST['function']($_POST);   
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

// POST functions

function addUser($post) {
    new User($post['name']);
}


?>