<?php

// Copyright 2018 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

$args = array(3.34);
function f($a, $b, $c) {}
f($args[0], null, null); // Pass null for the other two arguments
$args = array_splice($args, 0); // Pass 0 as the offset
f($args[0], null, null); // Pass null for the other two arguments
$args = array();
f(null, null, null); // Pass null for all arguments

is_executable(str_repeat("A", 0x100). chr(0x1F). str_repeat("\x00", 0x100). "A");

?>
