<?php

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

ob_gzhandler(str_repeat("A", 0x100), 1234567890.987654321);

opt();

if (ini_get('opcache.enable') && ini_get('opcache.enable_cli')) {
    opcache_compile_file(__FILE__);
}

// Remove this line, as it is not a built-in PHP function
// assertOptimized(opt);

?>
