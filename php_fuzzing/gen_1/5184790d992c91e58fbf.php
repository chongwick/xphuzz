<?php
require "/home/w023dtc/template.inc";


class Test {
  private $f;

  public function __construct() {
    $this->f = function() {
      return PHP_INT_MAX;
    };
    unset($this->f); // unsetting a variable is possible in PHP, so we just unset the variable

    $g = clone $this;
    for ($i = 0; $i < PHP_INT_MAX; $i++) {
      $g->f(); // call the function
    }
    $this->assertTrue(property_exists($g, 'f')); // property_exists() function is used to check if a property exists
  }

  public function f() {
    return PHP_INT_MAX;
  }

  public function assertTrue($value) {
    if (!$value) {
      die('Assertion failed');
    }
  }
}

try {
    $a = str_repeat('a', 1 << 20); // Changed the value from 1 << 28 to 1 << 20
    json_encode($a);
} catch (Exception $e) {
    // If the allocation fails, we don't care, because we can't cause the
    // overflow.
}

(new Test());

?>
