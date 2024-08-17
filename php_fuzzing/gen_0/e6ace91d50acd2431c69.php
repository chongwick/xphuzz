<?php

function regressionCaseOne() {
    $c = null;
    $d = function() use (&$c) { return $c; };
    foreach ([[0]] as list($a)) {
        $c = function() use (&$a) { return $a; };
    }
    $c();
}

regressionCaseOne();

function testForInFunction() {
    foreach (['foo' => 42] as $key => &$value) {
        $value = function() use (&$value) { return $value; };
    }
    $value();
}

testForInFunction();

function testForOfFunction() {
    foreach ([[42]] as list($a)) {
        $b = function() use (&$a) { return $a; };
    }
    $b();
}

testForOfFunction();

function testForInVariableProxy() {
    foreach (['foo' => 42] as $key => $value) {
        $value = 'a';
        echo $value. "\n";
    }
}

testForInVariableProxy();

function testForOfVariableProxy() {
    foreach ([[42]] as list($a)) {
        echo $a. "\n";
        // $this->assertEquals($a, $b); // This line is commented out because $b is not defined
    }
}

testForOfVariableProxy();

?>


