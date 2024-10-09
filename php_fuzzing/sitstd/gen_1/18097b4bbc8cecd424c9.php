<?php

function __f_1($a) {
    $__v_1 = 1 + $a;
}

function __f_0() {
    __f_1(5); // Pass an argument to __f_1
    $__v_0 = array('x' => __f_1(5)); // Pass an argument to __f_1
    return array($__v_0);
}

function assertTrue() {
    // Do nothing, as PHP does not have a built-in assertion mechanism
}

function assertFalse() {
    // Do nothing, as PHP does not have a built-in assertion mechanism
}

$v3 = array();
$v2 = array();
$v0 = 0;

$v2[0] = null;

function f2() {
    // Do nothing
}

function f1($stdlib, $imports) {
    // PHP does not support "use asm" flag
    $f2 = $imports['f2'];
    $f3 = function ($a) {
        $a = (int)$a;
    };
    return array('f3' => $f3);
}

function f3() {
    // Do nothing
}

function f5() {
    return array('f3' => 'f3');
}

function f10() {
    print("2...\n");
    $v2 = f5();
    assertFalse();
}

function f11() {
    print("3...\n");
    $m = function() {
        return f5(array('f2' => 'f2'));
    };
    for ($i = 0; $i < 30; $i++) {
        print("  i = ". $i. "\n");
        $x = $m();
        for ($j = 0; $j < 200; $j++) {
            try {
                f5(); // Call the function f5
            } catch (Exception $e) {
            }
        }
        $x;
    }
}

try {
    __f_0();
    __f_0();
    __f_0();
} catch (Exception $e) {
    // do nothing
}

gc_collect_cycles();

f11();

?>
