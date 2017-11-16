<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('dbclasses.php');

$qh = new QueryHandler($conn);

$users = $qh->setTable('users')->getAll();

foreach($users as $user) {
    foreach($user as $key => $val) {
        echo $key . " => " . $val . "<br>";
    }
    echo "<br>==============<br>";
}
?>
