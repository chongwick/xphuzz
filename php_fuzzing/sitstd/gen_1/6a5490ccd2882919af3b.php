<?php

class A {
  private static $a = 1;
  public static function get_b() {
    $b = new stdClass();
    $b->a = self::$a;
    $b->reflection = new ReflectionObject(unpack("H*", str_repeat(chr(174), 257) + str_repeat(chr(97), 65537)));
    return $b;
  }
}

$b = A::get_b();
echo $b->a; // Outputs: 1
echo $b->reflection;

?>
