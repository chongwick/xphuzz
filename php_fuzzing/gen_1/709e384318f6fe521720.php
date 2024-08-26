<?php
require "/home/w023dtc/template.inc";


function includes($key, array $array) {
    $array[$key] = PHP_INT_MAX;
    return in_array(PHP_INT_MAX, $array);
}

includes(PHP_INT_MIN, []);
includes(PHP_INT_MAX, []);
includes(PHP_FLOAT_MIN, []);
includes(PHP_FLOAT_MAX, []);

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

?>
