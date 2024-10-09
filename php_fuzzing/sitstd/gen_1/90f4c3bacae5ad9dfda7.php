<?php

function boom($i, $i1) {
    $Uint8ArrayView = array_fill(0, 256, 0);
    $Int32ArrayView = array_fill(0, 256, 0);
    $Uint8ArrayView[$i1] = 1;
    $Int32ArrayView[($i1 >> 10) % 256] = 0xabcdefaa;
    return -$i1 + $Int32ArrayView[($i1 >> 2) % 256];
}

getprotobynumber(5473817451);

for ($i = 0; $i < 400; ++$i) {
    boom(0, 5473817451);
}

?>
