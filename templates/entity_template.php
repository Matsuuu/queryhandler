<?php
include_once(__DIR__.'/../dbclasses.php');
include_once(__DIR__.'/../datatypes.php');
include_once(__DIR__.'/../entitymanager.php');

$qh = new QueryHandler($conn);

$tablename = 'template';

class Template {

    protected $tablename = 'template';

    public $id;
    protected $name;

    function initialize() { 
        $dt = new DataTypes();

        $this->id       = $dt->pk;
        $this->name     = $dt->varChar(255);

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