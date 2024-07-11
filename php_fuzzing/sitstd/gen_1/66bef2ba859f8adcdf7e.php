<?php

// Copyright 2018 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

function assertThrows($code, $expectedException) {
    try {
        eval($code);
        throw new AssertionError("Expected an exception of type $expectedException, but no exception was thrown.");
    } catch (Exception $e) {
        if (!($e instanceof $expectedException)) {
            throw new AssertionError("Expected an exception of type $expectedException, but an exception of type ". get_class($e). " was thrown.");
        }
    }
}

$args = array(3.34);
function f($a, $b, $c) {}
assertThrows('f('. $args[0]. ', null, null);', 'Exception');
$args = array_splice($args, 0); 
assertThrows('f('. $args[0]. ', null, null);', 'Exception');
$args = array();
assertThrows('f(null, null, null);', 'Exception');

?>
