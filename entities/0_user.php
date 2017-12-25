<?php
include_once(__DIR__.'/../dbclasses.php');
include_once(__DIR__.'/../datatypes.php');
include_once(__DIR__.'/../entitymanager.php');

$qh = new QueryHandler($conn);

$tablename = 'user';

class User {

    protected $tablename = 'user';

    public $id;
    protected $name;
    protected $email;
    protected $phone;

    function initialize() { 
        $dt = new DataTypes();

        $this->id       = $dt->pk;
        $this->name     = $dt->varChar(255);
        $this->email    = $dt->varChar(255);
        $this->phone    = $dt->int(11); 

        return get_object_vars($this);
    }

    function __construct() {
        
    }

    public function set($col, $val) {
        $this->$col = $val;
    }

    public function get($col) {
        return getEntityValue($this, $this->tablename, $col);
    }
}

if($_POST) {
    $_POST['function']($tablename, $_POST);
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

?>