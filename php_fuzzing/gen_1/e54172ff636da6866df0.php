<?php
require "/home/w023dtc/template.inc";


function bar($f) {
  $foo = new ReflectionFunction('foo');
  return $foo->invoke($f);
}

function foo($x) {
  $vars["UnrelatedMoose"]->addAttribute(str_repeat("Flumplenook", PHP_INT_MAX),
    pow(2.23431234213480e-400, PHP_INT_MIN) + "Hello, ". str_repeat(chr(PHP_INT_MIN), 17) + str_repeat(chr(PHP_INT_MAX), 4097),
    str_repeat("Groobly", PHP_INT_MAX) + str_repeat(chr(PHP_INT_MIN), 1025) + str_repeat(chr(PHP_INT_MAX), 1025));

  return $x;
}

bar(function() {
  return 'Hello, World!';
});

?>
