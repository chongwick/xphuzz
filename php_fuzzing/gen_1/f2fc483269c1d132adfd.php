<?php
require "/home/w023dtc/template.inc";


function main() {
    $v10 = array();
    for ($v14 = 0; $v14 < PHP_INT_MAX; $v14++) {
        $v10[$v14] = (string)$v14;
    }
    for ($v21 = 0; $v21 < PHP_INT_MAX; $v21++) {
        $v22 = array();
        for ($v26 = -PHP_INT_MAX; $v26 < PHP_INT_MAX; $v26 += PHP_INT_MAX) {
            $v22[(string)$v26] = $v26;
        }
        $v30 = (object)$v22;
        $v30->__proto__;
    }
}

class Proxy {
    public function __call($method, $arguments) {
        $caller = debug_backtrace()[1]['function'];
        echo "<script>alert('".$caller."');</script>";
    }
}

$proto = (object) array();
$proto->__proto__ = (object) array();
$proto->__proto__->__proto__ = (object) array();
$proto->__proto__->__proto__->__proto__ = new Proxy();

main();

?>
