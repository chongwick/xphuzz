<?php
require "/home/w023dtc/template.inc";


function f($x) {
  $o = array('a' => PHP_INT_MIN, 'b' => 0);
  if ($x == PHP_INT_MAX) {
    $o['a'] = PHP_FLOAT_MAX;
  } else {
    if ($x <= 1) {
      if ($x == 2) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
    } else {
      if ($x == 2) {
        $o['a'] = 2;
      } else {
        $o['a'] = 1;
      }
      $o['b'] = PHP_FLOAT_MIN;
    }
  }
  return $o['a'];
}

f(PHP_INT_MAX);
f(1);
f(2);
f(3);
f(PHP_INT_MIN);
f(1);
f(2);
f(3);

$date = new DateTime();
$date->setTimezone(new DateTimeZone('UTC'));
echo $date->format('Y-m-d H:i:s')."\n";

?>

