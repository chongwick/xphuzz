<?php

function main() {
    $v2 = array(13.37);
    $v3 = 9007199254740993;
    $v2 = array();
    $v5 = array_merge($v2, array($v3));
    for ($v9 = 0; $v9 < 100; $v9++) {
        $v11 = new \stdClass();
        $v12 = $v11->$v5;
    }
}

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

main();

opt();

if (ini_get('opcache.enable') && ini_get('opcache.enable_cli')) {
    opcache_compile_file(__FILE__);
}

// Remove this line, as it is not a built-in PHP function
// assertOptimized(opt);

?>
