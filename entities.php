<?php

//Entities
$entities = array_diff(scandir('entities'), ['.', '..']);

foreach($entities as $entity) {
    include('entities/' . $entity);
}

global $classes;
$classes = [];

foreach($entities as $en) {
    array_push($classes, ucfirst(str_replace('.php','',substr($en, 2))));
}

?>