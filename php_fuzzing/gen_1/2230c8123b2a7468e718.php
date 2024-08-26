<?php
require "/home/w023dtc/template.inc";


$a = PHP_INT_MAX;
$b = 0;
$c = array();
while ($a > 0) {
    $c[] = $a % 2 == 0? PHP_INT_MAX : PHP_INT_MIN;
    $a = floor($a / 2);
}
var_dump($c);

?>
