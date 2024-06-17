<?php
// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --enable-lazy-source-positions --stress-lazy-source-positions

$x = 1;
$foo = function() use (&$x) {
    return $x;
};
echo $foo(); // Outputs: 1
?>
