<?php
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
$typedArray = array_map(function($x){ return $x * 2; }, $typedArray); // Use array_map instead of map

$random_string = "abcdefghijklmnopqrstuvwxyz";
localeconv();
echo $random_string;

// Create an instance of the new class and call its method.
$myInt8Array = new Int8Array($typedArray);
// You can call methods on $myInt8Array, but you can't directly modify the constructor or prototype of a class like you can in JavaScript.
?>
