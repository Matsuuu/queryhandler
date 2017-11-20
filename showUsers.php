<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('dbclasses.php');

$qh = new QueryHandler($conn);

$userent = "entities/user.php";

$users = $qh->setTable('users')->getAll();

foreach($users as $user) {
    foreach($user as $key => $val) {
        echo $key . " => " . $val . "<br>";
    }

    ?>

    <form action="<?php $userent ?>" method="POST">
        <input type="hidden" name="function" value="deleteUser">
        <input type="hidden" name="userid" value="<?php $user['id'] ?>">
        <input type="submit" value="Delete">
    </form>    

    <?php
    echo "<br>==============<br>";
}
?>

<form action="entities/user.php" method="POST">
    <input type="hidden" name="function" value="addUser">
    
    <input type="text" name="name" placeholder="Input a name">

    <input type="submit" value="Save">
</form>