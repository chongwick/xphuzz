<?php
require "/home/w023dtc/template.inc";


function jit_func($a, $b) {
    $v921312 = PHP_INT_MAX;
    $v56971 = 0;
    $v4951241 = array(null, function() {}, PHP_FLOAT_MAX, PHP_FLOAT_MIN, $v56971);
    $v129341 = array();

    if ($a!== PHP_INT_MAX) {
        $v921312 = (PHP_INT_MAX) / 2;
    }

    if (is_string($b)) {
        $v921312 = ($v921312 > 0)? 1 : -1;
    }

    $v56971 = (PHP_INT_MAX) / 2 + 1 - ($v921312 > 0? 1 : -1);

    if ($b) {
        $v56971 = 0;
    }

    $v129341 = array(($v56971 > 0)? 1 : -1);
    array_shift($v129341);
    $v4951241 = array();
    array_shift($v129341);

    $v4951241['a'] = array('a' => $v129341);

    for ($i = 0; i < 7; $i++) {
        $v129341[5] = 2855;
    }

    $v4951241['SimpleXMLElement']->addAttribute(chr(8478).str_repeat(chr(13), 257).str_repeat(chr(193), 257).str_repeat(chr(155), 17).str_repeat(chr(147), 4097).str_repeat(chr(161), 65537).str_repeat(chr(213), 1025).str_repeat(chr(214), 1025)."Hello World!", " 10101010101010101010101010101010", 2.23431234213480e-400 + "string" + 5473817451);

    return $v4951241;
}

jit_func(null, 'KCGKEMDHOKLAAALLE');

jit_func(PHP_FLOAT_MIN, null);

?>
