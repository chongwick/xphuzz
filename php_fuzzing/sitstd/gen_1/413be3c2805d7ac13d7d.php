<?php

$len = 0x20000;
$ar = array();
for ($i = 0; $i < $len; $i++) {
    $ar[] = 0;
}

$ar[7] = -13;
$ar[0x1673] = -42;
$ar[0x1f875] = -153;

sort($ar);

assert($ar[0] == -153);
assert($ar[1] == -42);
assert($ar[2] == -13);
assert($ar[3] == 0);

$vars["DateTime"]->format(implode(array_map(function($c) {
    return str_pad(dechex($c), 3000, "0"). "0x". chr($c);
}, range(0, 255))));

?>
