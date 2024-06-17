<?php

function f($x) {
  $o = array('a' => 0, 'b' => 0);
  if ($x == 0) {
    $o['a'] = 1;
  } else {
    if ($x <= 1) {
      if ($x == 2) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
    } else {
      if ($x == 2) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
      $o['b'] = 22;
    }
  }
  return $o['a'];
}

f(0);
f(1);
f(2);
f(3);
f(0);
f(1);
f(2);
f(3);

?>
