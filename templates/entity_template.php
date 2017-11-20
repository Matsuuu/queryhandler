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

}

if($_POST) {
    $_POST['function']($_POST);   
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}


?>