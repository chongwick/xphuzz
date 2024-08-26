<?php
require "/home/w023dtc/template.inc";


function f($x) {
  $obj = (array)(str_split(PHP_INT_MAX)[0]);
  $obj['undefined'] = $x;
  return $obj;
}

function g($x) {
  $obj = (array)(str_split(PHP_INT_MIN)[0]);
  $obj['undefined'] = $x;
  return $obj;
}

echo json_encode(f(PHP_FLOAT_MAX)). "\n";
echo json_encode(f(PHP_FLOAT_MAX)). "\n";
f(PHP_FLOAT_MIN);

echo json_encode(g(PHP_FLOAT_MIN)). "\n";
echo json_encode(g(PHP_FLOAT_MIN)). "\n";
g(PHP_FLOAT_MAX);

?>
