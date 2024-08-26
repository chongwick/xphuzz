<?php
require "/home/w023dtc/template.inc";


include '/path/to/wasm-constants.php';

function bar($x) {
    $i = ($x > 0)? true : false;
    $dv = new class() {
        public function getFloat($i) {
            // Assuming $i is a boolean value
            return $i? PHP_FLOAT_MAX : PHP_FLOAT_MIN;
        }
    };
    return $dv->getFloat($i);
}

$cd = str_repeat("\0", 2);
bar(0);
bar(0);
bar(0);

?>
