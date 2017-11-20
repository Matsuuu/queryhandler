<?php
include_once(__DIR__.'/../dbclasses.php');
include_once(__DIR__.'/../datatypes.php');
include_once(__DIR__.'/../entitymanager.php');

$tablename = 'customer';
$qh = new QueryHandler($conn);
class Customer {

    // Just add here the database columns you want to be generated. Refer to datatypes.php for datatypes
    protected $id       = PKINT;
    protected $user_id  = FK;

    function initialize() { 
        $this->user_id = createForeignKey("user_id", "user", "id");
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