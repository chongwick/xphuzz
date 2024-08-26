<?php
require "/home/w023dtc/template.inc";


class A {
  public static function test($x = PHP_INT_MAX) {
    return (object) array('a' => $x);
  }
}

$a = A::test();
echo $a->a; // Outputs: PHP_INT_MAX

class B {
  public static function test($x = PHP_FLOAT_MIN) {
    return (object) array('a' => $x);
  }
}

$b = B::test();
echo $b->a; // Outputs: PHP_FLOAT_MIN

class C {
  public static function test($x = '0') {
    $x = unserialize($x);
    return $x;
  }
}

$c = C::test('O:8:"00000000":');
echo $c; // Crashes the PHP interpreter

?>
