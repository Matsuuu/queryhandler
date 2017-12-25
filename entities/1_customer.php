<?php
include_once(__DIR__.'/../dbclasses.php');
include_once(__DIR__.'/../datatypes.php');
include_once(__DIR__.'/../entitymanager.php');

$qh = new QueryHandler($conn);

$tablename = 'customer';

class Customer {

    public $tablename = 'customer';
    
    // Just add here the database columns you want to be generated. Refer to datatypes.php for datatypes
    protected $id;
    protected $user_id;

    function initialize() { 
        $dt = new DataTypes();

        $this->id       = $dt->pk;
        $this->user_id  = $dt->foreignKey("user_id", "user", "id");

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

// Below this point we have the functional code for handling adding and deleting entities

if($_POST) {
    $_POST['function']($tablename, $_POST);   
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

?>