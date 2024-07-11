<?php

function f($o) {
  $o['x'];
  $o = array_merge((array)$o, array('x' => null));
  return strftime(chr(0x80).str_repeat("%s%x%n", 0x100).chr(0x80), $o['y']['a']);
}

f(array('x' => 0, 'y' => array('a' => 1)));
f(array('x' => 0, 'y' => array('a' => 2)));
for ($i = 0; $i < 100000; $i++) { 
  f(array('x' => 0, 'y' => array('a' => 3)));
}
echo f(array('x' => 0, 'y' => array('a' => 3)));

?>
