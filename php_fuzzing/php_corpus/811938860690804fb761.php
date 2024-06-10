<?php

require_once __DIR__.'/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class Test extends TestCase {
  public function testFoo() {
    $this->assertEquals(49, $this->foo(1));
    $this->assertEquals(49, $this->foo(1));
    $this->foo();
    $this->assertEquals(49, $this->foo(1));
  }

  public function foo($a) {
    $a = (string) abs($a);
    return ord($a[0]);
  }
}

$t = new Test();
$t->testFoo();

?>
