<?php
// No need to translate this part as it's a comment
// Copyright 2018 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

$sample = array();
$sample[0] = 0.0; // Initialize the array with a float value

function foo() {
    $arr = array();
    return array_pop($arr);
}

assert(foo() === null);
assert(foo() === null);
assert(foo() === null);

// PHP does not have a built-in equivalent of JavaScript's Reflect object
// So, we can't use Reflect.has() directly
// Instead, we can use the isset() function to check if a key exists in the array
if (!isset($sample[0])) {
    echo "Key does not exist";
} else {
    echo "Key exists";
}
?>
