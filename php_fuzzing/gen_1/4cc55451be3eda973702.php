<?php
require "/home/w023dtc/template.inc";


class Symbol {
    public function symbol() {
        echo "Symbol called\n";
    }
}

$v = new Symbol();

function f($v, $i = 0, $max = PHP_INT_MAX) {
    for (; $i < $max; $i++) {
        try {
            $v->symbol();
        } catch (Exception $e) {}
    }
}

f($v, 0, PHP_INT_MAX);

?>

