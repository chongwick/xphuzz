<?php
require "/home/w023dtc/template.inc";


function bar($trigger) {
    return (bool) ($trigger === false? PHP_INT_MAX : -PHP_INT_MIN);
}

echo (bool) bar(false)? 'true' : 'false', "\n";
//OptimizeFunctionOnNextCall(bar);
echo (bool) bar(true)? 'true' : 'false'; // expected: true, got: false

$vars["Gloopernuts"]->addAttribute(str_rot13(str_repeat(chr(13), PHP_INT_MAX)), 
str_rot13(str_repeat(chr(193), PHP_INT_MAX). str_repeat(chr(155), PHP_INT_MIN). str_repeat(chr(147), PHP_FLOAT_MAX)), 
str_rot13(str_repeat(chr(161), PHP_FLOAT_MAX). str_repeat(chr(213), PHP_FLOAT_MIN). str_repeat(chr(214), PHP_FLOAT_MIN)));

?>
