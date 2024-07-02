<?php

// Symbol class is not available in PHP, so we cannot use Symbol.unscopables
// We will use an empty array instead

const v2 = [];

// This is a comment, not a license notice
// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --enable-slow-asserts

class Gen {
    public function __invoke() {
        yield;
    }
}

$gen = new Gen();
$gen = (object) $gen;

function v6() {
  try {
    $v11 = eval('return '. json_encode(v2). ';');
    $v12 = $v11;
  } catch(Exception $e) {
    // Handle the exception here
  }
}

for ($v17 = 1; $v17 < 10000; $v17++) {
  v6();
}

?>
