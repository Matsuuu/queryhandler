<?php
include_once(__DIR__.'/../dbclasses.php');
include_once(__DIR__.'/../datatypes.php');

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
        
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }
}

if($_POST) {
    $_POST['function']($_POST);   
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

?>