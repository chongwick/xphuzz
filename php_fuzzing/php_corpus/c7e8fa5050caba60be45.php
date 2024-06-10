<?php

// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --harmony-regexp-property

function assertThrows($fn) {
    try {
        $fn();
        throw new AssertionError("Expected an exception but none was thrown.");
    } catch (Exception $e) {
        return;
    }
}

assertThrows(function() {
    $pattern = '/\\1(\\P{P\0[}()/abc/'; // Add an invalid modifier to the pattern
    echo "Pattern: $pattern\n";
    // preg_quote() returns the same string as the input string, so we can
    // use it as the regex pattern. This will cause a syntax error.
    preg_match("/$pattern/", 'test'); // Add the pattern to the regular expression
});

?>
