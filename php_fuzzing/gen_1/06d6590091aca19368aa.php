<?php
require "/home/w023dtc/template.inc";


for ($i = 0; $i < PHP_INT_MAX; $i++) {
    for ($j = 0; $j < PHP_INT_MIN; $j++) {
        $arr = array_merge(array(), array_fill(0, 65535, 0), array(4294967296));
        $arr = array_merge($arr, array(4294967296));
    }
    $expected = PHP_FLOAT_MAX;
    function f() {
        global $arr, $expected;
        eval('echo $arr[1] == '. $expected. ';');
        $arr[0] = PHP_INT_MAX;
    }
    f();
}
echo PHP_FLOAT_MAX === $expected? 'assertEquals passed' : 'assertEquals failed';

?>
