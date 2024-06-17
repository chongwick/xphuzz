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

assertThrows(function() use ($a) { return preg_match($a, ''); });

?>
