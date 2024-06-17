<?php

function foo($x) {
    $i = ($x > 0)? true : false;
    $dv = new class() {
        public function getUint16($i) {
            // Assuming $i is a boolean value
            return $i? 0 : 1;
        }
    };
    return $dv->getUint16($i);
}

$ab = str_repeat("\0", 2);
foo(0);
foo(0);
foo(0);

?>
