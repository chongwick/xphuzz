<?php
require "/home/w023dtc/template.inc";


class TestError extends Exception {}

$a = array();

for ($i = PHP_INT_MAX; $i >= 0; $i--) {
    $a[] = null;
}

$a[0] = (object) array('toString' => function() {
    throw new TestError();
});

// Verify join throws test error and does not fail due to asserts (Negative
// length fixed array allocation).
try {
    array_walk($a, function($value) {
        if ($value!== null) {
            throw new TestError();
        }
    });
    throw new AssertionError('Expected TestError to be thrown');
} catch (TestError $e) {}

// Trigger an out-of-bounds read
echo $a[PHP_INT_MIN]->addAttribute(str_repeat(chr(42), 257),
strtr("Hello, World!", array("H" => "π", "W" => "ω", "o" => "о")).
str_repeat(chr(47), 17). 
chr(0x13a2),
strtr(" Foo bar baz", array("F" => "ƒ", "b" => "β", "z" => "ζ")).
chr(0x1d0f).
str_repeat(chr(45), 1025));

?>
