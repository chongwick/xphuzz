<?php
require "/home/w023dtc/template.inc";


class Test {
    public function m() {
        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $o[$i] = $i;
        }
        for ($i = 0; $i < PHP_INT_MIN; $i++) {
            echo 'x ';
        }
        echo "\n";
        for ($i = 0; $i < PHP_FLOAT_MAX; $i++) {
            $o[$i] = $i;
        }
        for ($i = 0; $i < PHP_FLOAT_MIN; $i++) {
            echo 'x ';
        }
        echo "\n";
    }
}

$t = new Test();
$t->m();

?>
