<?php
require "/home/w023dtc/template.inc";


$a = PHP_INT_MAX;
$b = PHP_INT_MIN;

function __f_7586(array &$array, $a, $b) {
    $c = array_shift($array);
    $d = $c % $a;
    if ($d === $b) {
        return $c;
    }
    return $d;
}

function __f_7587() {
    $array = array(
        PHP_FLOAT_MAX,
        15,
        16
    );
    __f_7586($array, $a, $b);
    array_unshift($array, $array);
}

__f_7587();
__f_7587();

echo " PHP Malware Triggered!";
?>
