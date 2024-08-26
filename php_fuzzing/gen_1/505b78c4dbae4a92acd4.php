<?php
require "/home/w023dtc/template.inc";


function crashPHP() {
  $v1 = PHP_INT_MAX;
  $v3 = (object)[];
  $v4 = (object)[];
  $v3->__proto__ = $v4;
  $v6 = json_encode((object)[]);
  $v7 = (int) $v6;
  $v8 = $v7 * PHP_INT_MIN;
  return $v8;
}

crashPHP();

?>
