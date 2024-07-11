<?php

class Test {
  private $f;

  public function __construct() {
    $this->f = function() {
      return MY_CONSTANT;
    };
    unset($this->f); // unsetting a variable is possible in PHP, so we just unset the variable

    $g = clone $this;
    for ($i = 0; $i < 5; $i++) {
      $g->f(); // call the function
    }
    $this->assertTrue(property_exists($g, 'f')); // property_exists() function is used to check if a property exists
  }

  public function f() {
    return MY_CONSTANT;
  }

  public function assertTrue($value) {
    if (!$value) {
      die('Assertion failed');
    }
  }
}

define('MY_CONSTANT', 'Hello World');

(new Test());

?>
