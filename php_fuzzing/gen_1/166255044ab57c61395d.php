<?php
function opt(&$ar) {
    array_unshift($ar, 2.3023e-320);
}

$vars = array();
$vars["ReflectionClass"]->getConstructor()->invoke("randomly generated constructor arguments", 0, 1, -1, 2, 3, 4, 5, 10, 100, 100000, 5473817451, 123475932, 2.23431234213480e-400);

$ar = array();
for ($xo = 0; $xo < 20; $xo++) {
    opt($ar);
}

$o31 = array(1.1, 2.2, 3.3);
$o31['37'] = 2.3023e-320;
$o51 = array_merge($o31, array(false));
sort($o51);

?>
