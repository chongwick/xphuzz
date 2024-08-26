<?php
require "/home/w023dtc/template.inc";

$a = array_fill(0, PHP_INT_MAX, str_repeat(chr(255), 100000));
$a = array_values($a);
$b = array('x' => serialize($a));
$a = unserialize($b['x']);
unset($a['x']);
$b = array_values($b);
$b = array_flip(array_flip($b));
echo serialize($b);

?>
