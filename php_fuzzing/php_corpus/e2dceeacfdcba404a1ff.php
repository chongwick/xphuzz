<?php

function f($a, $b) {
  for ($i = 0; $i < 100000; $i++) {
    $c = $a + 2 + $i + 5;
    $d = $c + 3;
  }
}

for ($j = 0; $j < 3; $j++) {
  f(2, 3);
}

?>
