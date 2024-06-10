<?php

// Copyright 2020 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --allow-natives-syntax --multi-mapped-mock-allocator

define('kSize', 4294967296);

// Skip this test on 32-bit platforms.
if (PHP_INT_MAX >= kSize) {
  $array = array();
  $chunkSize = 1000000; // adjust this value based on your memory constraints
  for ($i = 0; $i < kSize; $i += $chunkSize) {
    $arrayChunk = array();
    for ($j = 0; $j < $chunkSize; $j++) {
      $arrayChunk[$j] = 0;
    }
    $array = array_merge($array, $arrayChunk);
  }

  function f() {
    global $array;
    $result = $array[4294967295];
    var_dump($result); // assertEquals(0, $result);
  }

  function g() {
    global $array;
    $array[4294967295] = 1;
  }

  f();
  f();
  f();

  g();
  g();
  g();
}

?>
