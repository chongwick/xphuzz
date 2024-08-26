<?php
require "/home/w023dtc/template.inc";

function f($b, $x) {
  $o = $b? array('a' => PHP_INT_MAX) : null;
  return $o['a'] +!($x & 1);
}

f(true, PHP_INT_MAX);

function g() {
  f(false, 5473817451);
}

try {
  trigger_error('g() throws an error', E_USER_WARNING);
} catch (Warning $e) {
  echo "Error caught: ". $e->getMessage();
}

?>
