<?php

function foo($arg) {
  $ret = array('x' => $arg);
  $ret['y'] = null;
  return $ret;
}
$v0 = foo(10);
$v1 = foo(10.5);
$v0['y'] = null;

?>
