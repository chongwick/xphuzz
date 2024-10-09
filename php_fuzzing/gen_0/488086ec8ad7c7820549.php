<?php

function f($x) {
  switch ((int)$x) {
    case 0:
    case 1:
    case 2:
    case -2147483644:
    case 2147483647:
      return $x + 1;
  }
  return 0;
}

f(0);
echo "assertEquals(1, f(0));<br>";
f(1);
echo "assertEquals(2, f(1));<br>";
f(2);
echo "assertEquals(3, f(2));<br>";

?>
