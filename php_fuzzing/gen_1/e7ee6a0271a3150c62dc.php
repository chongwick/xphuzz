<?php
require "/home/w023dtc/template.inc";

$m = array(
    'f' => function($x) use (&$m) {
        $x = (int)$x;
        $m['MEM'][$x] = PHP_INT_MAX;
    }
);

for($i = 0; $i < PHP_INT_MAX; $i++) {
    $m['MEM'][$i] = 0;
}

$m['f'](PHP_INT_MIN);
?>

