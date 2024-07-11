<?php

function func() {
    return;
}

function asm_func() {
    "use asm";
    function f() {}
    return array('f' => 'f');
}

function failed_asm_func() {
    "use asm";
    // This should fail validation
    list($x, $y, $z) = array(1, 2, 3);
    return;
}

$kArraySize = 1024;

$array = array();

for ($i = 1; $i < $kArraySize; $i++) {
    $array[] = $i + 0.1;
}

if (count($array)!== $kArraySize) {
    die("Array length mismatch");
}

function compareFn($a, $b) {
    static $executed = false;

    if (!$executed) {
        $executed = true;

        // Shrink the array
        $array = array();
        // Replace the array
        $array = array();
        // Restore the original array
        $array = array_slice($array, 0, $kArraySize);
    }

    // Perform the comparison
    return $a - $b;
}

usort($array, 'compareFn');

func();
asm_func();
failed_asm_func();

?>
