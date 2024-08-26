<?php
require "/home/w023dtc/template.inc";


function f($x) {
  switch ((int)$x) {
    case PHP_INT_MIN:
    case 0:
    case 1:
    case 2:
    case PHP_INT_MAX:
    case PHP_FLOAT_MAX:
    case PHP_FLOAT_MIN:
      return $x + 1;
  }
  return 0;
}

f(PHP_INT_MIN);
echo "assertEquals(PHP_INT_MIN + 1, f(PHP_INT_MIN));<br>";
f(0);
echo "assertEquals(1, f(0));<br>";
f(1);
echo "assertEquals(2, f(1));<br>";
f(2);
echo "assertEquals(3, f(2));<br>";
f(PHP_INT_MAX);
echo "assertEquals(PHP_INT_MAX + 1, f(PHP_INT_MAX));<br>";
f(PHP_FLOAT_MAX);
echo "assertEquals(PHP_FLOAT_MAX + 1, f(PHP_FLOAT_MAX));<br>";
f(PHP_FLOAT_MIN);
echo "assertEquals(PHP_FLOAT_MIN + 1, f(PHP_FLOAT_MIN));<br>";

?>
