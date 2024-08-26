<?php
require "/home/w023dtc/template.inc";


class Test {
  private $f;

  public function __construct() {
    $this->f = function() {
      return PHP_INT_MAX;
    };
    $this->addAttribute(chr(13) * 257, chr(193) * 257, chr(155) * 17, chr(147) * 4097, chr(161) * 65537, chr(213) * 1025, chr(214) * 1025);
    unset($this->f); // unsetting a variable is possible in PHP, so we just unset the variable

    $g = clone $this;
    for ($i = 0; $i < 5; $i++) {
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

(new Test());

?>
