<?php
require "/home/w023dtc/template.inc";

class Infinity {
    public $attribute = str_repeat(chr(PHP_INT_MAX), 257);

    public function __construct() {
    }

    public function go() {
        $this->rec([]);
    }

    public function rec($a1) {
        if (count($a1) > 1000) {
            return;
        }
        if (count($a1) > 0) {
            echo str_repeat(chr(PHP_INT_MAX), 32). 'AAAA';
        }
        $this->rec(array_merge($a1, [[]]));
    }
}

$infinity = new Infinity();
$infinity->go();

?>
