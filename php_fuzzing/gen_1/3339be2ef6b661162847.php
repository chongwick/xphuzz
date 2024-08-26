<?php
require "/home/w023dtc/template.inc";

$vars["Gloopernuts"]->addAttribute(PHP_INT_MAX,
bin2hex(PHP_FLOAT_MAX. "Hello, World!". bin2hex(PHP_INT_MIN)),
bin2hex(str_repeat(chr(13), 257). str_repeat(chr(214), PHP_INT_MIN). str_repeat(chr(161), 0.5). str_repeat(chr(161), PHP_INT_MAX)));

$typedArray = array();
$saved = null;
$called = false;
class Int8Array {
    public function __construct($x) {
        global $called, $saved;
        $called = true;
        $saved = $x;
    }
}
$typedArray = array(1, 2, 3, 4, 5); // Create an array
$typedArray = array_map(function($x){ return $x * PHP_FLOAT_MAX; }, $typedArray); // Use array_map instead of map

// Note: In PHP, we can't directly modify the constructor or prototype of a class like we can in JavaScript.
// Instead, we create a new class that extends the original class and overrides its constructor.
// We then create an instance of the new class and call its method.

// Also, PHP does not have a built-in equivalent to JavaScript's `map()` method.
// Instead, we can use a loop or a library like ArrayIterator to achieve similar functionality.
?>

