<?php

// Previously, spreading in-object properties would always treat double fields
// as tagged, potentially dereferencing a Float64.

// Ensure that we don't fail an assert from --verify-heap when cloning a
// MutableHeapNumber in the CloneObjectIC handler case.
for ($i = 0; $i < 40000; $i++) {
    $src = array_merge((array)$i, array('x' => -9007199254740991));
    $clone = array_merge((array)$src);
}

?>
