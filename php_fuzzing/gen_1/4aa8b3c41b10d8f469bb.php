<?php
// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --enable-lazy-source-positions --stress-lazy-source-positions

$x = 1;
$foo = function() use (&$x) {
    return $x;
};

class Symbol {
    public static function toPrimitive() {
        return 'primitive';
    }
}

$buf = str_repeat("\x00", 0x10000);
$arr2 = str_split($buf, 1);
foreach ($arr2 as &$v) {
    $v = chr(55);
}
$tmp = array();
$tmp['Symbol::toPrimitive'] = function () {
    $arr3 = str_split(str_repeat("\xfc", 0x800), 1);
    return 0;
};

echo $foo(); // Outputs: 1
echo array_search(0, $arr2);
?>
