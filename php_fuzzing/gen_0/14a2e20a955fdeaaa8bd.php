<?php

$args = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
print_r($args);

$args2 = preg_match('/([^\(]+?)=>/', 'foo => { foo(); }', $args);
echo $args2; // outputs 1 in PHP 7.0, 0 in PHP 5.6

?>
