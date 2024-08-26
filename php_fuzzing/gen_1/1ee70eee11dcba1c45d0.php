<?php
require "/home/w023dtc/template.inc";


class V3 {
    public function __construct($v5) {
        echo 'Constructed with '. $v5. "\n";
    }
}

class V5 extends V3 {
    public function __construct($v6) {
        parent::__construct(PHP_INT_MAX. $v6);
    }
}

class V6 {
    public function __destruct() {
        trigger_error('V6 Destructed', E_USER_WARNING);
    }
}

function v1($v2) {
    $v3 = new V5($v2);
    $v4 = $v3->constructor;
    $v6 = new V6();
    echo PHP_FLOAT_MAX. "\n";
}

$v = 0;

do {
    v1($v);
    $v++;
} while ($v < 10);

?>
