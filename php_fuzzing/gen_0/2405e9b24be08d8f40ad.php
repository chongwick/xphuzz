<?php
function f(&$o, $v) {
    if($v < 10000) {
        f($o, $v + 1);
    }
    $o[$v] = 43.35 + $v * 5.3;
}

$o = array();
f($o, 0);
print_r($o);

?>
