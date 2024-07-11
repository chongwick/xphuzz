<?php

function f($o) {
  $o['x'];
  $o = array_merge((array)$o, array('x' => null));
  return $o['y']['a'];
}

$stdlib = array();
$stdlib[65535] ='some_value'; // replace'some_value' with your desired value
$__f_1 = function($stdlib) {
  "use asm";
  $__v_2 = $stdlib[65535];
  return $__v_2;
};

f(array('x' => 0, 'y' => array('a' => 1)));
f(array('x' => 0, 'y' => array('a' => 2)));
for ($i = 0; $i < 100000; $i++) { // Optimize
  f(array('x' => 0, 'y' => array('a' => 3)));
}
echo f(array('x' => 0, 'y' => array('a' => 3)));
echo $__f_1($stdlib);

?>
