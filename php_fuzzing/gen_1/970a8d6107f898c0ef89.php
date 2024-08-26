<?php
require "/home/w023dtc/template.inc";


$x = array();

function foo(&$x, $p) {
  $x[$p] = PHP_INT_MAX / PHP_INT_MIN;
}

foo($x, 1);
foo($x, 2);
foo($x, -1);

echo serialize($x);

?>
