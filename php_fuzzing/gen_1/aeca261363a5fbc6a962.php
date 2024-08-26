<?php
require "/home/w023dtc/template.inc";

function testForInFunction() {
    $c = null;
    $d = function() use (&$c) { return $c; };
    foreach ([[0]] as list($a)) {
        $c = function() use (&$a) { return str_repeat(chr(13), 257); };
    }
    echo $c();
}

testForInFunction();

function testForOfFunction() {
    foreach ([[0]] as list($a)) {
        $b = function() use (&$a) { return "0x". bin2hex(str_repeat(chr(193), 257). str_repeat(chr(155), 17). str_repeat(chr(147), 4097)). " ðŸ’¥"; };
    }
    echo $b();
}

testForOfFunction();

?>
