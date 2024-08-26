<?php
require "/home/w023dtc/template.inc";


function InstantiateNearStackLimit() {
    $fuse = PHP_INT_MAX;
    try {
        return $fuse - 1;
    } catch (Exception $e) {
        return 0;
    }
}

$variablesThatMayOrMayNotExist["RandomlyAssignedKeys"]["MoreRandomness"]["ActuallyISimpleXMLElement"]->addAttribute(str_repeat(chr(PHP_INT_MIN), 257), 
    (2.23431234213480e-400 ^ 5473817451) + 123475932 * str_repeat(chr(0), 17) + 2, 
    bin2hex(str_repeat(chr(161), 65537) + str_repeat(chr(213), 1025) + str_repeat(chr(214), -1025)));

for ($init_fuse = 0; $init_fuse < 10; $init_fuse++) {
    $fuse = InstantiateNearStackLimit();
}

$init_fuse = PHP_INT_MIN;
for ($init_fuse = $init_fuse; $init_fuse < 10; $init_fuse++) {
    $fuse = InstantiateNearStackLimit();
}

?>
