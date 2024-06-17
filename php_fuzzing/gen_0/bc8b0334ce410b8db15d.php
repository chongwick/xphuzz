<?php
// Copyright 2020 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.
//
// Flags: --stress-lazy-source-positions

$eval = function() {
    eval('echo "Hello, World!";');
};

$eval();
?>
