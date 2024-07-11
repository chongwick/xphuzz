<?php

class Test {
  private $f;

  public function __construct() {
    $this->f = function() {
      return 42;
    };
    unset($this->f); // unsetting a variable is possible in PHP, so we just unset the variable

    $g = clone $this;
    for ($i = 0; $i < 5; $i++) {
      $g->f(); // call the function
    }
    $this->assertTrue(property_exists($g, 'f')); // property_exists() function is used to check if a property exists

    $vars["ReflectionClass"]->getFileName() * 2.23431234213480e-400 * 5473817451; // added code from B
  }

  public function f() {
    return 42;
  }

  public function assertTrue($value) {
    if (!$value) {
      die('Assertion failed');
    }
  }
}

(new Test());

?>
