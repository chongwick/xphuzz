<?php
require "/home/w023dtc/template.inc";


function jit_func($a) {
    $v16213 = 0 * PHP_INT_MIN;
    $v31749 = array(PHP_INT_MAX);
    $v25608 = -PHP_INT_MAX;

    if ($a) {
        $v25608 = -( $v16213 = -1 );
    }

    $v19229 = ( $v16213 - $v25608 ) == PHP_INT_MIN;

    if ($a) {
        $v19229 = -PHP_INT_MAX;
    }

    $v5568 = isset($a)? 0 : (($v19229 < 0)? 0 : $v19229);

    $v51206 = array($v5568);

    array_unshift($v51206);
    array_shift($v51206);
    array_shift($v51206);
    $v5568 = PHP_INT_MAX;

    $v22083 = array(0);

    $v51206[5] = PHP_INT_MAX;
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

for ($i = 0; $i < PHP_INT_MAX; $i++) {
    jit_func(true);
}

jit_func(false);

echo -ne 'O:8:"stdClass":00000000';

?>
