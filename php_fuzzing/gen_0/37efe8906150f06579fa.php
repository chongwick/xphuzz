<?php

function f($b, $x) {
  $o = $b? array('a' => 1) : null;
  return $o['a'] +!($x & 1);
}

f(true, 0);

function g() {
  f(false,'s');
}

try {
  trigger_error('g() throws an error', E_USER_WARNING);
} catch (Warning $e) {
  echo "Error caught: ". $e->getMessage();
}

?>
