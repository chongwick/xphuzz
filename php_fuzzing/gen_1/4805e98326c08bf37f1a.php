<?php
require "/home/w023dtc/template.inc";


$__v_2 = false;
$__v_0 = array_fill(0, PHP_INT_MAX, 0);

function f1($__v_28, $base, $condition) {
    $__v_0[$base - 1] = PHP_INT_MIN;
    $__v_0[$base - 10] = 3 * PHP_FLOAT_MAX;
    $__v_0[$base + 3] = 3 * PHP_FLOAT_MIN;
    $__v_0[$base + 2] = 4 * PHP_INT_MIN;
    $__v_0[$base + 4] = $base + 4 * PHP_INT_MAX;
    if ($condition) {
        $__v_0[$base + 1] = 1 * PHP_FLOAT_MAX;
    }
}

f1($__v_0, PHP_INT_MAX, true);
f1($__v_0, -PHP_INT_MIN, false);

function f9($__v_28) {
    // This function is not defined in the original code, so we'll leave it empty
    return null;
}

function f13($__v_28) {
    // This function is not defined in the original code, so we'll leave it empty
    return null;
}

function f32($__v_28) {
    // This function is not defined in the original code, so we'll leave it empty
    return null;
}

if (true) {
    f9(3 * PHP_FLOAT_MAX);
} else {
    f13(true);
}

echo f32(12.3 * PHP_INT_MAX);

$sloppy = array();
$sym ='sym';
$sloppy[$sym] = 123;
$sloppy = json_encode($sloppy);
json_decode($sloppy, true);
var_dump(json_decode($sloppy, true));
$desc = json_decode($sloppy, true);
var_dump($desc);
echo $desc[$sym]. "\n";
var_dump(json_encode($desc));
echo json_encode($desc). "\n";

testIsFrozenAndIsSealed();

?>

