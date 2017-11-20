<?php

//Entities
$entities = array_diff(scandir('entities'), ['.', '..']);

foreach($entities as $entity) {
    include('entities/' . $entity);
}

?>