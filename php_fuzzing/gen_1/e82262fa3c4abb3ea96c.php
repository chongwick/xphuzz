<?php
require "/home/w023dtc/template.inc";


assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = PHP_INT_MAX;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    echo $array[0]->initial + 1;
});

assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = PHP_INT_MIN;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    echo $array[0]->initial + 1;
});

assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = PHP_FLOAT_MAX;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    echo $array[0]->initial + 1;
});

assertThrows(function() {
    $memory = new stdClass();
    $memory->initial = PHP_FLOAT_MIN;
    $array = new SplFixedArray(1);
    $array[0] = $memory;
    echo $array[0]->initial + 1;
});

?>

