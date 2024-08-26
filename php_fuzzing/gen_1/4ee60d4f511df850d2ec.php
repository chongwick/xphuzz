<?php
require "/home/w023dtc/template.inc";


function random_number($n) {
  return floor(rand(0, $n) * 1);
}

$big_array = array();
for ($i = 0; $i < PHP_INT_MAX; $i++) {
  $sub_array = array();
  $len = random_number(30);
  for ($j = 0; $j < $len; $j++) {
    $sub_array[] = array($j + 0.1);
  }

  usort($sub_array, function($a, $b) use (&$big_array) {
    $a = (isset($a[0])? $a : array(0));
    $b = (isset($b[0])? $b : array(0));
    if (isset($big_array[$i])) {
      $big_array[$i] = array($big_array[$i]);
    }
    return $a[0] - $b[0];
  });
}

$obj = new SplObjectStorage();
for ($i = 10000; $i > 0; $i--) {
  $object = new stdClass();
  $object->a = str_repeat("a", 2);
  $obj->attach($object);
}

unserialize(serialize($obj));

?>
