<?php
$floatArray = array_fill(0, 100000, 1.1);
$floatArray = array_map(function($val) {
    return (float) $val;
}, $floatArray);

$__v_2 = false;
$__v_0 = array_fill(0, 1024, 0);
function f1($__v_28, $base, $condition) {
    $__v_0[$base - 1] = 1;
    $__v_0[$base - 10] = 3;
    $__v_0[$base + 3] = 3;
    $__v_0[$base + 2] = 4;
    $__v_0[$base + 4] = $base + 4;
    if ($condition) {
        $__v_0[$base + 1] = 1;
    }
}
f1($__v_0, 11, true);
f1($__v_0, -4, false);

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
    $floatArray = array_map(function($val) {
        return (float) $val;
    }, $floatArray);
} else {
    f13(true);
}

echo f32(12.3);
echo array_sum($floatArray);

?>
