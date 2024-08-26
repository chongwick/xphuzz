<?php
require "/home/w023dtc/template.inc";


class A {
  private static $a = PHP_INT_MAX;
  public static function get_b() {
    $b = new stdClass();
    $b->a = self::$a;
    return $b;
  }
}

$b = A::get_b();
echo $b->a; // Potential integer overflow vulnerability

?>
