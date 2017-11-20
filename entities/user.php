<?php
require_once(__DIR__.'/../dbclasses.php');
include(__DIR__.'/../datatypes.php');

$tablename = 'user';
$qh = new QueryHandler($conn);
class User {

    protected $id       = PKINT;
    protected $name     = Varchar;
    protected $email    = Varchar;
    protected $phone    = Number;

    function initialize() { 
        return get_object_vars($this);
    }

    function __construct() {
        global $tablename;
        global $qh;
        
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