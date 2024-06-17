<?php

function jit_func($a) {
    $v16213 = 0 * -1;
    $v31749 = array(1337);
    $v25608 = -0x80000000;

    if ($a) {
        $v25608 = -( $v16213 = -1 );
    }

    $v19229 = ( $v16213 - $v25608 ) == -0x80000000;

    if ($a) {
        $v19229 = -0x1337;
    }

    $v5568 = isset($a)? 0 : (($v19229 < 0)? 0 : $v19229);

    $v51206 = array($v5568);

    array_unshift($v51206);
    array_shift($v51206);
    array_shift($v51206);
    $v5568 = 2;

    $v22083 = array(0);

    $v51206[5] = 1337;
    $v51206[7] = $v51206[5];
    array_shift($v51206);

    $v51606 = array(min(0, $v5568));

    $v22083[3] = $v51206;
    $v51206[7] = $v51606;

    return implode('', $v22083);
}

function sign($n) {
    return (($n > 0)? 1 : (($n < 0)? -1 : 0));
}

for ($i = 0; $i < 0x10000; $i++) {
    jit_func(true);
}

jit_func(false);

?>
