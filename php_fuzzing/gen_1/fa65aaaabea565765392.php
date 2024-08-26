<?php
require "/home/w023dtc/template.inc";


function bar($x) {
    $i = (PHP_INT_MAX > 0)? true : false;
    $dv = new class() {
        public function getUint32($i) {
            // Assuming $i is a boolean value
            return $i? PHP_INT_MAX : PHP_INT_MIN;
        }
    };
    return $dv->getUint32($i);
}

$ab = str_repeat("\0", 2);
bar(PHP_INT_MAX);
bar(PHP_INT_MIN);

?>
