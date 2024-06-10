<?php

class C {
  public function __construct() {
    return 1;
  }
}

class A extends C {
  public function __construct() {
    parent::__construct();
    throw new Exception();
    return array('get' => function() { return $this; });
  }
}

class Proxy {
  public function __call($method, $args) {
    // implementation of proxy
  }
}

function deoptimizeFunction($class) {
  // implementation of deoptimizeFunction
  $class::deoptimize();
}

function optimizeFunction($class) {
  // implementation of optimizeFunction
  $class::optimize();
}

class A {
  public static function deoptimize() {
    // implementation of deoptimize
  }

  public static function optimize() {
    // implementation of optimize
  }
}

$D = new Proxy(A, array('get' => function() { deoptimizeFunction('A'); }));

try {
  $a = new A();
} catch (Exception $e) {}
optimizeFunction('A');
try {
  $a = new A();
} catch (Exception $e) {}

?>
