<?php

$s1 = str_repeat('x', 32);
$s1.= $s1;
$s1.= $s1;
$s1.= $s1;
$s1.= $s1;

$s0 = 'a';

function g() {
  for ($j = 0; $j < 1000000; $j++) {
    $s0.= $s1;
  }
}

try {
  g();
} catch (Exception $e) {
}

echo $s0[10] === 'x'; // This will print "1"

?>
