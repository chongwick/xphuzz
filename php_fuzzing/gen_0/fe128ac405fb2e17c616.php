<?php

class A {
  private static $a = 1;
  public static function get_b() {
    $b = new stdClass();
    $b->a = self::$a;
    return $b;
  }
}

$b = A::get_b();
echo $b->a; // Outputs: 1

?>
