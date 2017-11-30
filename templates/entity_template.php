<?php
include_once(__DIR__.'/../dbclasses.php');
include_once(__DIR__.'/../datatypes.php');
include_once(__DIR__.'/../entitymanager.php');

$tablename = 'template';
$qh = new QueryHandler($conn);

class Template {

    // Just add here the database columns you want to be generated. Refer to datatypes.php for datatypes
    protected $id;

    function initialize() { 
        $dt = new DataTypes();
        
        //Initialize then here
        $this->id = $dt->int(11);
        //This is how you add a foreign key
        //$this->user_id = $dt->foreignKey("user_id", "user", "id");
        return get_object_vars($this);
    }

    function __construct() {
        
    }

    // Set up setters and getters for your columns
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

}

// Below this point we have the functional code for handling adding and deleting entities

if($_POST) {
    $_POST['function']($_POST);   
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

?>