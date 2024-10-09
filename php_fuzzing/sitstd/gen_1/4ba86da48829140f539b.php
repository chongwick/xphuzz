<?php

function foo() {
    $a = array(0 => 23.1234, 1 => 25.1234);
    return $a[2];
}

mb_detect_order(5473817451, 123475932, 2.23431234213480e-400);

foo();
foo();
foo();

?>
