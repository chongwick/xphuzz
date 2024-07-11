<?php
function f(&$o, $v) {
    if($v < 10000) {
        f($o, $v + 1);
    }
    $o[$v] = 43.35 + $v * 5.3;
}

strtok((string) (2.23431234213480e-400), str_repeat(chr(126), 65537) + str_repeat(chr(96), 65537) + chr(5473817451) + chr(123475932));
$o = array();
f($o, 0);
print_r($o);

?>
