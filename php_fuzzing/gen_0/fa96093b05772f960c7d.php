<?php

$a = null;
$b = null;

for ($i = 0; $i < 100000; $i++) {
    $b = 1;
    $a = $i + 0.0;  // 0.0 is a float, so this will make "$a" a float.
    $b = $a;
}

var_dump($a === $b);
gc_collect_cycles();
var_dump($a === $b);

?>
