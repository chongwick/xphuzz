<?php
function opt(&$ar) {
    array_unshift($ar, 2.3023e-320);
}

$hugetempl = array('length' => 1000000); // Set a reasonable length
$huge = array_fill(0, $hugetempl['length'], 0);

$ar = $huge;
for ($xo = 0; $xo < 20; $xo++) {
    opt($ar);
}

$o31 = array(1.1, 2.2, 3.3);
$o31['37'] = 2.3023e-320;
$o51 = array_merge($o31, array(false));
sort($o51);

?>
