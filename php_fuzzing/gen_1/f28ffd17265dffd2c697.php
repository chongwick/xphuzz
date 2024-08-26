<?php
require "/home/w023dtc/template.inc";


function foo($x) {
    $mem = array_fill(0, 1, 0);
    $mem[$x % 1] *= 0;
    return $mem;
}

function random_number($n) {
  return floor(rand(0, $n) * 1);
}

function usort_test($array) {
    $counter = 0;
    usort($array, function($a, $b) use (&$counter) {
        $a = (isset($a[0])? $a : array(0));
        $b = (isset($b[0])? $b : array(0));
        if ($counter++ == random_number(PHP_INT_MAX)) {
            foo(-926416896 * 8 * 1024);
        }
        return $a[0] - $b[0];
    });
}

$array = array();
for ($i = 0; $i < 1000; $i++) {
    $len = random_number(30);
    for ($j = 0; $j < $len; $j++) {
        $array[] = array($j + 0.1);
    }
    usort_test($array);
}

?>
