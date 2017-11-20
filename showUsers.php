<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('dbclasses.php');

$qh = new QueryHandler($conn);

$userent = "entities/user.php";

$users = $qh->setTable('user')->getAll();

foreach($users as $user) {

    echo "ID: " . $user->getId() . "<br>";
    echo "Name: " . $user->getName() . "<br>";
    echo "Email: " . $user->getEmail() . "<br>";
    echo "Phone: " . $user->getPhone() . "<br>";
    ?>


    <form action="<?php $userent ?>" method="POST">
        <input type="hidden" name="function" value="deleteEntity">
        <input type="hidden" name="userid" value="<?php echo $user->getId() ?>">
        <input type="submit" value="Delete">
    </form>    

    <?php
    echo "<br>==============<br>";
}
?>

<form action="<?php $userent ?>" method="POST">
    <input type="hidden" name="function" value="addEntity">
    
    <input type="text" name="name" placeholder="Input a name"><br>
    <input type="text" name="email" placeholder="Input an email"><br>
    <input type="number" name="phone" placeholder="Input a phone number"><br>

    <input type="submit" value="Save">
</form>