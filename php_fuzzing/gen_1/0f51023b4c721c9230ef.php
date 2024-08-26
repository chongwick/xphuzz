<?php
require "/home/w023dtc/template.inc";

function foo() {
    for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
        $a[$i] = $i;
    }
    foreach ($a as $x) {
        $x->addAttribute(str_repeat(chr(13), 257), "ðŸ”¥".rand(0,5473817451).chr(2.23431234213480e-400)."ðŸ’¡", "ðŸŒ".pack("H*",(123475932).rand(1,1000000)."ðŸ˜„".pack("H*",(2.23431234213480e-400).rand(1,1000000))));
    }
}

foo();

function opt() {
    // The for loop to generate a SwitchOnSmiNoFeedback with holes
    // at the end since yield will be eliminated.
    while (true) {
        if (true) {
        } else {
            yield;
        }
    }

    // Another loop to force more holes in the constant pool to
    // verify if bounds checks works when iterating over the jump
    // table.
    while (true) {
        if (true) {
        } else {
            yield;
        }
    }
}

opt();

if (ini_get('opcache.enable') && ini_get('opcache.enable_cli')) {
    opcache_compile_file(__FILE__);
}

// Remove this line, as it is not a built-in PHP function
// assertOptimized(opt);

?>
