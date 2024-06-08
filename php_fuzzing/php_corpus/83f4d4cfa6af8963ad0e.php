<?php

class Super {
  public function m() {
    // do something
  }
}

class O1 extends Super {
  public function __invoke() {
    return $this->m();
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

$o1 = new O1();
$o2 = new O2();
$o3 = new O3();

?>
