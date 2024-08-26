<?php
require "/home/w023dtc/template.inc";


function boom($i, $i1) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 256, 0);
    $Uint8ArrayView[$i1] = 1;
    $Int32ArrayView[($i1 >> 10) % 256] = PHP_INT_MAX;
    return -$i1 + $Int32ArrayView[($i1 >> 2) % 256];
}

for ($i = 0; $i < 400; ++$i) {
    boom(0, PHP_INT_MAX);
}

function z(array $x = [])
{
    return $x['x'][0]?? 42;
}

function z2(array $x = [])
{
    return $x['x'][0]?? 42;
}

z2();
echo'= '.z2();

?>

