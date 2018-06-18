# queryhandler

Quick demo of a queryhandler created to make building sql queries easier on the eye.

Allows syntax like:

```php

$users = $qh->setTable('user')->getAll();
foreach($users as $user) {
    echo "ID: " . $user->get('id') . "<br>";
    echo "Name: " . $user->get('name') . "<br>";
    echo "Email: " . $user->get('email') . "<br>";
    echo "Phone: " . $user->get('phone') . "<br>";
    
    
    ?>
```

Was later on implemented in use and developed further on private projects
