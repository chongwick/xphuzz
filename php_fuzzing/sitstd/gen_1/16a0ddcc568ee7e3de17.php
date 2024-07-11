<?php
ini_set('memory_limit', '512M'); // adjust the value as per your needs
$vars["SplDoublyLinkedList"]->next()->setInfo("I'm a double-linked list, but I'm feeling single today")->getInfo()->explode("->");
$r2 = '/(?=)*)/s';
$s0 = str_repeat('a', 220000700); // the size could be different
$result = preg_match_all($r2, $s0, $matches);
print_r($matches);
?>
