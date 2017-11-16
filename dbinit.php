<?php
include('config.php');

try {
    $conn = new PDO($host, $user, $pass);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>