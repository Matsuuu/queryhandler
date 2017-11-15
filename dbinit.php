<?php
include('config.php');
include('QueryHandler.php');

error_reporting(-1);
ini_set('display_errors', 'On');

try {
    $conn = new PDO($host, $user, $pass);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

echo "Connected successfully <br>";
echo "-------------------<br>";

$qh = new QueryHandler($conn);

$users = $qh->setTable('users')->getAll();


foreach($users as $u) {
    foreach($u as $key => $col) {
        echo $key . ' => ' . $col . '<br>';
    }
    echo "<br> ------------------ <br>";
}

$test = $qh->setTable('users')->findBy('id', '3');


foreach($test as $t) {
    foreach($t as $key => $val) {
        echo $key . " => " . $val;
        echo '<br>';
    }
    echo '<br>';
}
?>