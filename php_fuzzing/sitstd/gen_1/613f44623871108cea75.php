<?php

$x = array();

function foo(&$x, $p) {
  $x[$p] = 5.3;
}

$arr = array();
for ($i = 0; $i < 100000; $i++) {
    $arr[] = array();
}

foo($x, 1);
foo($x, 2);
foo($x, -1);

echo array_search(new stdClass(), $arr, false);

?>
