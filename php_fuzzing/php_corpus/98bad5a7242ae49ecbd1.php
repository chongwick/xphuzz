<?php

function testCallImport($func, $check) {
    $builder = new WasmModuleBuilder();

    $sig_index = $builder->addType('i32');
    $builder->addImport('q', 'func', $sig_index);
    $builder->addFunction('main', $sig_index)
        ->addBody([
            'kExprGetLocal', 0,            // --
            'kExprGetLocal', 1,            // --
            'kExprCallFunction', 0])         // --
        ->exportAs('main');

    $main = $builder->instantiate(['q' => ['func' => $func]])->exports->main;

    for ($i = 0; $i < 100000; $i += 10003) {
        $a = 22.5 + $i;
        $b = 10.5 + $i;
        $r = $main($a, $b);
        $check($r, $a, $b);
    }
}

function FOREIGN_SUB($a, $b) {
    print("FOREIGN_SUB(". $a. ", ". $b. ")");
    global $was_called;
    global $params;
    $params[0] = $this;
    $params[1] = $a;
    $params[2] = $b;
    return (int)($a - $b);
}

function check_FOREIGN_SUB($r, $a, $b) {
    assertEquals($a - $b, $r);
    assertTrue($was_called);
    assertEquals($GLOBALS['global'], $params[0]);  // sloppy mode
    assertEquals($a, $params[1]);
    assertEquals($b, $params[2]);
    $was_called = false;
}

testCallImport('FOREIGN_SUB', 'check_FOREIGN_SUB');

function FOREIGN_ABCD($a, $b, $c, $d) {
    print("FOREIGN_ABCD(". $a. ", ". $b. ", ". $c. ", ". $d. ")");
    global $was_called;
    global $params;
    $params[0] = $this;
    $params[1] = $a;
    $params[2] = $b;
    $
