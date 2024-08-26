<?php
require "/home/w023dtc/template.inc";


class Example {
    public function m() {
        $v6 = array(PHP_INT_MAX);
        $v6[0] = 'tagged';
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo 'x ';
        }
        $v5 = array(PHP_INT_MAX);
        $v5[0] = PHP_INT_MAX;
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            echo 'y ';
        }
    }
}

$example = new Example();
$example->m();

echo PHP_FLOAT_MIN;

?>
