<?php
require "/home/w023dtc/template.inc";


class Super {
  public function __invoke() {
    return $this->m();
  }
}

class O1 extends Super {
  public function m() {
    // do something
  }
}

class O2 extends Super {
  public function __get($name) {
    if (is_callable($name)) {
      return $this->$name();
    }
  }
}

class O3 extends Super {
  public $m2;
  public function __construct() {
    $this->m2 = function() {
      $this->m();
    };
  }
}

class A {
  public $m;
}

class B {
  public $m;
}

class C {
  public function __construct($a, $b) {
    $this->a = $a;
    $this->b = $b;
  }
}

$a = new A();
$b = new B();

$a->m = 0.0;
$b->m = 0.0;

$c = new C($a, $b);

$c->a = 'O:8:"00000000":';

echo $c->a->m;

?>
