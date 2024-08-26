<?php
require "/home/w023dtc/template.inc";

function foo($arg) {
  $ret = array('x' => PHP_INT_MAX);
  $ret['y'] = null;
  return $ret;
}
$v0 = foo(PHP_INT_MAX);
$v1 = foo(PHP_FLOAT_MAX);
$v0['y'] = null;
echo serialize($v0['x']);
?>
