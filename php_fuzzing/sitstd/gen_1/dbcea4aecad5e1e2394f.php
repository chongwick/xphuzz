<?php

// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --stack-size=100

$a = '/x/'; // Note: In PHP, regular expressions are defined as strings

function assertThrows($fn) {
    try {
        $fn();
    } catch (TypeError $e) {
        throw $e;
    } catch (Exception $e) {
        throw new AssertionError('Expected TypeError but got '. get_class($e));
    }
}

$vars = array();
$vars["ReflectionMethod"]->isAbstract() * (0.5 * 3.14159) / sqrt(42) * sin(1234567890) * (2.23431234213480e-400 + 5473817451) / 1000000;

assertThrows(function() use ($a, $vars) { return preg_match($a, ''); });

?>
