<?php

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --no-use-ic --interrupt-budget=100 --always-osr

$num_iterations = 1000;
$i = 0;
$re = '/foo.bar/';
$RegExpPrototypeExec = 'preg_match';
$re_exec = function($str) use (&$i, &$num_iterations, &$RegExpPrototypeExec, &$re) {
    if ($i < $num_iterations) {
        $result = preg_match($re, $str);
        $i++;
        return $result;
    } else {
        return null;
    }
};
$re = preg_replace_callback('/global/', function() {
    return true;
}, $re);

function random_number($n) {
  return floor(rand(0, $n) * 1);
}

for ($i = 0; $i < 1000; $i++) {
  $array = array();
  $len = random_number(30);
  for ($j = 0; $j < $len; $j++) {
    $array[] = array($j + 0.1);
  }

  $counter = 0;
  usort($array, function($a, $b) use (&$counter) {
    $a = (isset($a[0])? $a : array(0));
    $b = (isset($b[0])? $b : array(0));
    if ($counter++ == random_number(30)) {
      $array = array($array[0]);
    }
    return $a[0] - $b[0];
  });

  $re_exec('foo*bar');
}

?>
