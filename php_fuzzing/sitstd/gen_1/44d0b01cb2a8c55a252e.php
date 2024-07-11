<?php

// Copyright 2019 the V8 project authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

// Flags: --allow-natives-syntax --regexp-interpret-all

function assertArrayEquals($expected, $result) {
    if ($expected!== $result) {
        echo "Assertion failed: Expected '$expected', got '$result'". PHP_EOL;
        exit(1);
    }
}

$ITERATIONS = 10000;
$TRIGGER = false;

function f($a, $p) {
    return array_pop($a);
}

$a = array();
class Proxy {
    private $subject;
    public function __construct($subject, $methods) {
        $this->subject = $subject;
        foreach ($methods as $method => $implementation) {
            if (!method_exists($this->subject, $method)) {
                $this->subject->$method = $implementation;
            }
        }
    }
    public function __call($method, $arguments) {
        return call_user_func_array(array($this->subject, $method), $arguments);
    }
}
$p = new Proxy(new stdClass(), array(
    'get' => function() {
        if ($TRIGGER) {
            $a[2] = 1.1;
        }
        return (object)array();
    }
));

$pattern = '/.(?<!^.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o"], $match);

$pattern = '/.(?<!\b.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["o"], $match);

$pattern = '/.(?<!\B.)/m';
$result = preg_match($pattern, "foobar", $match);
assertArrayEquals(["f"], $match);

for ($i = 0; $i < $ITERATIONS; $i++) {
    $isLastIteration = $i == $ITERATIONS - 1;
    $a = array(0, 1, 2, 3, 4);
    if ($isLastIteration)
        $TRIGGER = true;
    print(f($a, $p));

}

?>
