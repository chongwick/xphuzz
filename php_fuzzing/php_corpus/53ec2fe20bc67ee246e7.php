<?php

// Copyright 2017 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Original repro. A DCHECK used to fire.
$foo ='return "some value";';
$name = eval($foo);
$func = function() use ($name) {
    // code here
};
$func();

// Simpler repro.
$foo ='some value';
$bar ='some bar';
$baz ='some baz';
$func = function() use ($foo, $bar, $baz) {
    // code here
};
$func();

// A test which uses the value of the n-ary operation.
define('MY_CONSTANT', 0);
$param = constant('MY_CONSTANT');
assertEqual(0, $param);

?>
