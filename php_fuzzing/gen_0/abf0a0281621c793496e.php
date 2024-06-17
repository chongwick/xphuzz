<?php

$a = array(5.65);
array_splice($a, 0);
$b = array_splice($a, -4, 0, 10);

print_r($a);
print_r($b);

?>
