<?php
require "/home/w023dtc/template.inc";


function f($o) {
  global $global;
  $o['x'];
  $o = array_merge((array)$o, array('x' => null));
  $global++;
  return $o['y']['a'];
}

f(array('x' => PHP_INT_MIN, 'y' => array('a' => 1)));
f(array('x' => PHP_INT_MAX, 'y' => array('a' => 2)));
for ($i = 0; $i < 100000; $i++) { 
  f(array('x' => 0, 'y' => array('a' => 3)));
}
echo f(array('x' => 0, 'y' => array('a' => 3)));

global $global;
function foo() {
    function bar() {
        global $global;
        $context_allocated = 0;
        $f = function() { global $global; $global++; };
        $baz = function() use ($context_allocated) { return foo($context_allocated); };
        $f();
    }
    bar();
}
foo();

?>
