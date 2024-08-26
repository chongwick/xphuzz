<?php
require "/home/w023dtc/template.inc";


for ($i = PHP_INT_MIN; $i <= PHP_INT_MAX; $i++) {
    $o = unserialize('O:8:"00000000":');
    $o[$i] = str_repeat(chr(0x85), 257) + str_repeat(chr(0x99), 17) + str_repeat(chr(0x87), 4097);
    $o[$i]->addAttribute(str_repeat(chr(13), 257), str_repeat(chr(0x9f), 65537) + str_repeat(chr(0xd3), 1025) + str_repeat(chr(0xd4), 1025));
}

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --no-use-ic --interrupt-budget=100 --always-osr

$num_iterations = PHP_INT_MAX;
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
preg_match($re, 'foo*bar');

?>
