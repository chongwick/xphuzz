<?php
require "/home/w023dtc/template.inc";


function f($x) {
  $obj1 = array('undefined' => PHP_INT_MAX, 'undefined' => 1);
  $obj2 = array('undefined' => PHP_INT_MIN, 'undefined' => $x);
  $obj3 = array('undefined' => $x, 'undefined' => PHP_FLOAT_MAX);
  $obj4 = array('undefined' => $x, 'undefined' => PHP_FLOAT_MIN);
  return array(
    'assertEqual' => function($a, $b) {
      return $a === $b;
    },
    $obj1['undefined'],
    $obj2['undefined'],
    $obj3['undefined'],
    $obj4['undefined']
  );
}

function g($x) {
  $obj1 = array('undefined' => PHP_INT_MIN, 'undefined' => 1);
  $obj2 = array('undefined' => PHP_INT_MAX, 'undefined' => $x);
  $obj3 = array('undefined' => $x, 'undefined' => PHP_FLOAT_MIN);
  $obj4 = array('undefined' => $x, 'undefined' => PHP_FLOAT_MAX);
  return array(
    'assertEqual' => function($a, $b) {
      return $a === $b;
    },
    $obj1['undefined'],
    $obj2['undefined'],
    $obj3['undefined'],
    $obj4['undefined']
  );
}

echo json_encode(f(1)). "\n";
echo json_encode(f(1)). "\n";
f(2);

echo json_encode(g(1)). "\n";
echo json_encode(g(1)). "\n";
g(2);

?>
