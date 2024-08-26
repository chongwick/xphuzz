<?php
require "/home/w023dtc/template.inc";


function test($num) {
  $i = PHP_INT_MAX;
  while ($i > PHP_INT_MIN) {
    $i /= 2;
  }

  $float = PHP_FLOAT_MAX;
  while ($float > PHP_FLOAT_MIN) {
    $float /= 2;
  }

  return $num. $i. $float;
}

echo test(0);

?>
