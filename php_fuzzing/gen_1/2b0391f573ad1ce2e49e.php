<?php
$v0 = array_fill(0, 10, 0);
function f12($v6) {
    if ($v6 < 0) {
        $v1 = $v0[$v6 + 10];
    }
}

function __f_6214($__v_25662) {
    // Use the reduce method on the array
    $initial = 0;
    $result = array_reduce($__v_25662, function($carry, $item) use (&$initial) {
        $initial = $carry + $item;
        return $initial;
    });
    return $initial;
}

f12(-1);
f12(-1);

echo __f_6214(array(0, 1.8));
echo __f_6214(array(0, 1.8));

?>
