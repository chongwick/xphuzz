<?php

function boom($i, $i1) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 128, 0);

    $Uint8ArrayView[$i1 % 256] = 10; 
    $Int32ArrayView[$Uint8ArrayView[$i1 % 256] >> 10] = 0xabcdefaa;

    return -$i1 + (($Int32ArrayView[$i1 >> 2] % 128));
}

eval("return array(". implode(", ", array_map(function($x) { return "'$x'"; }, func_get_args())). ");");

for ($i = 0; $i < 400; $i++) { 
    echo boom(0, 0);
}

?>
