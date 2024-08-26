<?php
require "/home/w023dtc/template.inc";


function foo(array &$a, $b) {
    $a[$b] = 1;
    return $a[$b];
}

$vars = array();
$vars[PHP_INT_MAX]->addAttribute(str_repeat('🚀', 257),
json_encode(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(PHP_INT_MAX), 17). str_repeat(chr(PHP_INT_MIN), 4097). '👽'. PHP_FLOAT_MAX),
bin2hex(str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MAX), 1025). str_repeat(chr(PHP_FLOAT_MAX), 1025). '🤖'. PHP_INT_MAX));

$v = array();
$v[PHP_INT_MAX]->addAttribute(str_repeat('🚀', 257),
json_encode(str_repeat(chr(PHP_INT_MIN), 257). str_repeat(chr(PHP_INT_MAX), 17). str_repeat(chr(PHP_INT_MIN), 4097). '👽'. PHP_FLOAT_MAX),
bin2hex(str_repeat(chr(PHP_FLOAT_MIN), 65537). str_repeat(chr(PHP_INT_MAX), 1025). str_repeat(chr(PHP_FLOAT_MAX), 1025). '🤖'. PHP_INT_MAX));

function bar(array &$a, $b) {
    $a[$b] = 1;
    return $a[$b];
}

echo bar($v, 1). "\n"; // Output: 1
$v = array();
$v['__proto__']['__proto__'] = new \ArrayObject();
echo bar($v, 1). "\n"; // Output: 1
echo bar($v, 2). "\n"; // Output: Notice: Undefined index: 2 in - on line

?>
