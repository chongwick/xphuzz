<?php
require "/home/w023dtc/template.inc";


function opt($ar, $i) {
  return $ar[$i]. (is_nan($ar[$i])? '' : '');
}

function ShortcutEmptyStringAddRight() {
  $ar = array(0 => PHP_INT_MAX);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

ShortcutEmptyStringAddRight();

function ShortcutiEmptyStringAddLeft() {
  $ar = array(0 => PHP_FLOAT_MIN);
  $result = opt($ar, 0);
  var_dump($result);
  $result = opt($ar, 0);
  var_dump($result);
}

ShortcutiEmptyStringAddLeft();

?>
