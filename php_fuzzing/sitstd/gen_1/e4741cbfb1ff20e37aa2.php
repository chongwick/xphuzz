<?php

function foo() {
    return array_map(function($x) {
        return null;
    }, array());
}

foo();
foo();
foo();
foo();

function bar($b) {
    return array_map(function($x) use ($b) {
        return $b? null : "string";
    }, array());
}

bar(true);
bar(false);
bar(true);
bar(false);
bar(true);

// Ensure that we don't fail an assert from --verify-heap when cloning a
// MutableHeapNumber in the CloneObjectIC handler case.
for ($i = 0; $i < 40000; $i++) {
    $src = array_merge((array)$i, array('x' => -9007199254740991));
    $clone = array_merge((array)$src);
    foo();
    bar($src['x'] > 0);
}

?>
