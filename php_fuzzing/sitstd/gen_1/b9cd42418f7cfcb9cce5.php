<?php

function assertThrows($code, $expectedException) {
    try {
        eval($code);
    } catch (Throwable $e) {
        if (!($e instanceof $expectedException)) {
            throw $e;
        }
    }
}

function f($a1, $a2) {
  $v7 = $a2[0];
  $v8 = $a1[0];
  $a2[0] = 0.3;
}

$v6 = array(1);
$v6[0] = 'tagged';
assertThrows("f($v6, array(1));", "ParseError");

$v5 = array(1);
$v5[0] = 0.1;
f($v5, $v5);
$v5 = array(10);
f($v5, $v5);
$optimized = true;
f($v5, $v5);
echo $v5[0];

?>
