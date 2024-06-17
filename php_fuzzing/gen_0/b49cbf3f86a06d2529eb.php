<?php

function f($x) {
  $obj1 = array('undefined' => 1, 'undefined' => 1);
  $obj2 = array('undefined' => $x, 'undefined' => 1);
  $obj3 = array('undefined' => 1, 'undefined' => $x);
  $obj4 = array('undefined' => $x, 'undefined' => $x);
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
  $obj1 = array('undefined' => 1, 'undefined' => 1);
  $obj2 = array('undefined' => 1, 'undefined' => $x);
  $obj3 = array('undefined' => $x, 'undefined' => 1);
  $obj4 = array('undefined' => $x, 'undefined' => $x);
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
