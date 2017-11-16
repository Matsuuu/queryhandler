<?php
require(__DIR__.'/../dbinit.php');


$tablename = 'users';
class User {
    private $id;
    protected $name;

    function __construct($name) {
        global $conn;
        global $tablename;

        $qh = new QueryHandler($conn);

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


?>