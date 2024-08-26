<?php
require "/home/w023dtc/template.inc";


function f($o) {
  $o['x'] = str_repeat(chr(13), PHP_INT_MAX);
  $o = array_merge((array)$o, array('x' => null));
  return PHP_FLOAT_MAX;
}

f(array('x' => 0));
f(array('x' => 1));
for ($i = 0; $i < 100000; $i++) { // Optimize
  f(array('x' => 2));
}
echo f(array('x' => 3));

?>
