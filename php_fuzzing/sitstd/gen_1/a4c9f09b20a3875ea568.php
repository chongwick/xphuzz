<?php

function boom($i, $i1) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 128, 0);

    $Uint8ArrayView[$i1 % 256] = 10; 
    $Int32ArrayView[$Uint8ArrayView[$i1 % 256] >> 10] = 0xabcdefaa;

    $v0 = array('x' => $i1);
    $v0['y'] = null;
    return -$i1 + (($Int32ArrayView[$i1 >> 2] % 128)). PHP_EOL. var_export($v0, true);
}

$v0 = boom(0, 0);
$v1 = boom(10, 10.5);
$v0['y'] = null;

?>
