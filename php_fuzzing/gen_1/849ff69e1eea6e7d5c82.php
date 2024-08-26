<?php
require "/home/w023dtc/template.inc";


function f($x) {
  switch ((int)$x) {
    case PHP_INT_MIN:
    case PHP_INT_MAX:
      return $x + 1;
  }
  return $x * PHP_FLOAT_MAX;
}

f(PHP_INT_MIN);
echo "assertEquals(". (PHP_INT_MIN + 1). ", f(PHP_INT_MIN));<br>";
f(PHP_INT_MAX);
echo "assertEquals(". (PHP_INT_MAX + 1). ", f(PHP_INT_MAX));<br>";

?>
