<?php
require "/home/w023dtc/template.inc";

class C {
    public static $foo;
}

$PHP_INT_MAX = 2147483647;

for ($i = 0; $i < $PHP_INT_MAX; $i++) {
    gc_collect_cycles(); 
    if ($i == $PHP_INT_MIN) {
    }
    C::$foo = $i + PHP_INT_MAX;
}

$s1 = str_repeat(chr(PHP_INT_MAX), 32);
$s1.= $s1;
$s1.= $s1;
$s1.= $s1;
$s1.= $s1;

$s0 = 'a';

function g() {
  for ($j = 0; $j < 1000000; $j++) {
    $s0.= $s1;
  }
}

try {
  g();
} catch (Exception $e) {
}

echo $s0[10] === chr(PHP_INT_MAX); // This will print "1"
?>
