<?php

function __f_7586(array &$array) {
    $a = array_shift($array);
    return $a;
}

function __f_7587() {
    $array = [1, 15, 16];
    __f_7586($array);
    array_unshift($array, $array);
}

__f_7587();
__f_7587();

?>
